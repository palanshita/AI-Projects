from flask_cors import CORS
from flask import Flask, request, render_template, jsonify
import tensorflow as tf
import numpy as np

print("TensorFlow version:", tf.__version__)
print("NumPy version:", np.__version__)

from tensorflow.keras import models
from tensorflow.keras.models import load_model
from tensorflow.keras.models import Sequential
import numpy as np
from PIL import Image
import cv2
import os

app = Flask(__name__)
CORS(app, resources={r"/predict": {"origins": "*"}})  # Restrict CORS to specific routes
app.config['UPLOAD_FOLDER'] = 'static/uploads'

# Load the model
try:
    model = load_model("model/traffic_sign_model.h5", compile=False)
except FileNotFoundError:
    print("Model file not found. Ensure the path is correct.")
except ValueError as e:
    print(f"Error loading model: {e}")
except Exception as e:
    print(f"Unexpected error: {e}")



# Class labels
class_labels = {
    0: "Speed Limit (20km/h)", 1: "Speed Limit (30km/h)", 2: "Speed Limit (50km/h)", 3: "Speed Limit (60km/h)",
    4: "Speed Limit (70km/h)", 5: "Speed Limit (80km/h)", 6: "End of Speed Limit (80km/h)", 7: "Speed Limit (100km/h)",
    8: "Speed Limit (120km/h)", 9: "No Passing", 10: "No Passing for Vehicles over 3.5 tons", 
    11: "Right-of-Way at Intersection", 12: "Priority Road", 13: "Yield", 14: "Stop", 15: "No Vehicles",
    16: "Vehicles over 3.5 tons Prohibited", 17: "No Entry", 18: "General Caution", 19: "Dangerous Curve Left",
    20: "Dangerous Curve Right", 21: "Double Curve", 22: "Bumpy Road", 23: "Slippery Road", 
    24: "Road Narrows on the Right", 25: "Road Work", 26: "Traffic Signals", 27: "Pedestrians", 
    28: "Children Crossing", 29: "Bicycles Crossing", 30: "Beware of Ice/Snow", 31: "Wild Animals Crossing", 
    32: "End of All Speed and Passing Limits", 33: "Turn Right Ahead", 34: "Turn Left Ahead", 
    35: "Ahead Only", 36: "Go Straight or Right", 37: "Go Straight or Left", 38: "Keep Right", 
    39: "Keep Left", 40: "Roundabout Mandatory", 41: "End of No Passing", 
    42: "End of No Passing for Vehicles over 3.5 tons"
}

@app.route('/')
def home():
    return 'Hello flask is working!'

@app.route('/upload', methods=['GET', 'POST'])
def upload_image():
    return render_template('templates/sign_recognition.html')

def predict_image(image_path):
    try:
        img = Image.open(image_path).convert('RGB')
        img = img.resize((32, 32))
        img = np.array(img) / 255.0
        img = np.expand_dims(img, axis=0)
        prediction = model.predict(img)
        class_id = np.argmax(prediction)
        return class_labels.get(class_id, "Unknown")
    except Exception as e:
        return str(e)

@app.route('/predict', methods=['POST'])
def predict():
    if 'file' not in request.files:
        return jsonify({'error': 'No file uploaded'}), 400

    file = request.files['file']
    if file.filename == '':
        return jsonify({'error': 'No selected file'}), 400

    filepath = os.path.join(app.config['UPLOAD_FOLDER'], file.filename)
    os.makedirs(app.config['UPLOAD_FOLDER'], exist_ok=True)
    file.save(filepath)

    prediction = predict_image(filepath)

    return render_template("sign_recognition.html", prediction=prediction, image=file.filename)

if __name__ == "__main__":
    app.run(debug=True, host='0.0.0.0', port=5000)
