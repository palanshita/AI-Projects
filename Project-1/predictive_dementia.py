# -*- coding: utf-8 -*-
"""
Spyder Editor

This is a temporary script file.
"""
import numpy as np
import pickle 
loaded_model=pickle.load(open('C:/Users/palan/OneDrive/Desktop/pythons data/de-dementia/trained_model.sav','rb'))

def pred(diabetic, alcohol_level, heart_rate, blood_oxygen_level, body_temperature, weight, mri_delay, age, cognitive_test_scores):
    user_input=np.array([[diabetic, alcohol_level, heart_rate, blood_oxygen_level, body_temperature, weight, mri_delay, age, cognitive_test_scores]])
    predicitions=loaded_model.predict(user_input)
    if(predicitions[0]==0):
        print("The person is not having dementia")
    else:
        print("The person is having dementia")
    #return predicitions[0]

pred(0,0.016973,78,93.032122,36.183874,56.832335,31.157633,61,1)