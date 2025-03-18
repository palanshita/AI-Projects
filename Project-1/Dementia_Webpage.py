# -*- coding: utf-8 -*-
"""
Created on Fri Apr 12 00:41:27 2024

@author: palan
"""

import numpy as np
import pickle 
import streamlit as st

loaded_model = pickle.load(open('C:/Users/palan/OneDrive/Desktop/pythons data/de-dementia/trained_model.sav','rb'))

def pred(diabetic, alcohol_level, heart_rate, blood_oxygen_level, body_temperature, weight, mri_delay, age, cognitive_test_scores):
    user_input = np.array([[diabetic, alcohol_level, heart_rate, blood_oxygen_level, body_temperature, weight, mri_delay, age, cognitive_test_scores]])
    predictions = loaded_model.predict(user_input)
    if predictions[0] == 0:
        return "The person is not having dementia"
    else:
        return "The person is having dementia"

def main():
    st.title("Dementia Prediction")
   # st.subheader("Enter value in float")
    st.caption(" Note: Enter float values wherever required.")
    diabetic = st.text_input("Diabetic")
    alcohol_level = st.text_input("Alcohol Level")
    heart_rate = st.text_input("Heart Rate")
    blood_oxygen_level = st.text_input("Blood Oxygen Level")
    body_temperature = st.text_input("Body Temperature")
    weight = st.text_input("Weight")
    mri_delay = st.text_input("MRI Delay")
    age = st.text_input("Age")
    cognitive_test_scores = st.text_input("Cognitive Test Scores")
    
    diagnosis = ''
    
    if st.button('Dementia Test Result'):
        if (diabetic != '' and alcohol_level != '' and heart_rate != '' and blood_oxygen_level != '' and body_temperature != '' and weight != '' and mri_delay != '' and age != '' and cognitive_test_scores != ''):
            diagnosis = pred(float(diabetic), float(alcohol_level), float(heart_rate), float(blood_oxygen_level), float(body_temperature), float(weight), float(mri_delay), float(age), float(cognitive_test_scores))
        else:
            diagnosis = "Please provide all input values."
        
    st.success(diagnosis)

if __name__ == '__main__':
    main()

#import numpy as np
#import pickle 
#import streamlit as st

#loaded_model=pickle.load(open('C:/Users/palan/OneDrive/Desktop/pythons data/de-dementia/trained_model.sav','rb'))

#def pred(diabetic, alcohol_level, heart_rate, blood_oxygen_level, body_temperature, weight, mri_delay, age, cognitive_test_scores):
 #   user_input=np.array([[diabetic, alcohol_level, heart_rate, blood_oxygen_level, body_temperature, weight, mri_delay, age, cognitive_test_scores]])
  #  predicitions=loaded_model.predict(user_input)
   # if(predicitions[0]==0):
    #     print("The person is not having dementia")
    # else:
    #     print("The person is having dementia")
    #return predicitions[0]
 #pred(0,0.016973,78,93.032122,36.183874,56.832335,31.157633,61,1)

 #def main():
 #    st.title("Dementia Prediction")
    
 #    diabetic=st.text_input("diabetic")
 #    alcohol_level=st.text_input("alcohol_level")
 #    heart_rate=st.text_input(" heart_rate")
 # #    blood_oxygen_level=st.text_input("blood_oxygen_level")
 #    body_temperature=st.text_input("body_temperature")
 #    weight=st.text_input("weight")
 #    mri_delay=st.text_input("mri_delay")
 #    age=st.text_input("age ")
 #    cognitive_test_scores=st.text_input("cognitive_test_scores")
    
    
 #    diagnosis=''
    
 #    if st.button('Dementia test result'):
 #        diagnosis =pred(diabetic, alcohol_level, heart_rate, blood_oxygen_level, body_temperature, weight, mri_delay, age, cognitive_test_scores)
        
        
 #    st.success(diagnosis)
    
    
    
    
    
 #if __name__ == '__main__':
 #    main() 