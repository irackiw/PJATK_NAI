'''
Data source: https://gist.github.com/ktisha/c21e73a1bd1700294ef790c56c8aec1f
'''

import pandas as pd
import numpy as np
from sklearn.model_selection import train_test_split
from sklearn.preprocessing import StandardScaler
from sklearn.svm import SVC
from sklearn.metrics import confusion_matrix
from sklearn.metrics import f1_score
from sklearn.metrics import accuracy_score
from sklearn.feature_selection import SelectKBest
from sklearn.feature_selection import chi2
from sklearn.feature_selection import VarianceThreshold
import matplotlib.pyplot as plt
import seaborn as sns

# load data
dataset = pd.read_csv('data/pima-indians-diabetes.csv')
diab.head()

# distribution of the classes
benign_df = cell_df[cell_df['Class'] == 2][0:200]
malignant_df = cell_df[cell_df['Class'] == 4][0:200]
axes = benign_df.plot(kind='scatter', x='Clump', y='UnifSize', color='blue', label='Benign')
malignant_df.plot(kind='scatter', x='Clump', y='UnifSize', color='red', label='Benign', ax=axes)

# identifying unwanted rows
cell_df = cell_df[pd.to_numeric(cell_df['BareNuc'], errors='coerce').notnull()]
cell_df['BareNuc'] = cell_df['BareNuc'].astype('int')

# remove unwanted columns
feature_df = cell_df[
    ['Clump', 'UnifSize', 'UnifShape', 'MargAdh', 'SingEpiSize', 'BareNuc', 'BlandChrom', 'NormNucl', 'Mit']]
X = np.asarray(feature_df)
y = np.asarray(cell_df['Class'])

# divide the data as train/test dataset
X_train, X_test, y_train, y_test = train_test_split(X, y, test_size=0.2, random_state=4)

# modeling svm
classifier = svm.SVC(kernel='linear', gamma='auto', C=2)

# print results
classifier.fit(X_train, y_train)

y_predict = classifier.predict(X_test)
print(classification_report(y_test, y_predict))