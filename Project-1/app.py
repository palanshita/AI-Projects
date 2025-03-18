# -*- coding: utf-8 -*-
"""
Created on Fri Apr 12 16:41:19 2024

@author: palan
"""

from flask import Flask, render_template, request, jsonify
import pickle
import numpy as np
import webbrowser
import threading

app = Flask(__name__)

loaded_model = pickle.load(open('C:/Users/palan/OneDrive/Desktop/pythons data/de-dementia/trained_model.sav','rb'))

@app.route('/')
def index():
    return render_template('index.html')

def open_browser():
    webbrowser.open('http://localhost:8501/')

@app.route('/pred', methods=['POST'])
def pred():
    if request.method == 'POST':
        diabetic = float(request.form['diabetic'])
        alcohol_level = float(request.form['alcohol_level'])
        heart_rate = float(request.form['heart_rate'])
        blood_oxygen_level = float(request.form['blood_oxygen_level'])
        body_temperature = float(request.form['body_temperature'])
        weight = float(request.form['weight'])
        mri_delay = float(request.form['mri_delay'])
        age = float(request.form['age'])
        cognitive_test_scores = float(request.form['cognitive_test_scores'])

        user_input = np.array([[diabetic, alcohol_level, heart_rate, blood_oxygen_level, body_temperature, weight, mri_delay, age, cognitive_test_scores]])
        prediction = loaded_model.predict(user_input)
        
        if prediction[0] == 0:
            result = "The person is not having dementia"
        else:
            result = "The person is having dementia"
            
        return jsonify({'result': result})

if __name__ == '__main__':
    threading.Timer(1, open_browser).start()
    app.run(debug=True)
