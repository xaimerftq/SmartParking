import mysql.connector
import pandas

from sklearn.preprocessing import MinMaxScaler
from sklearn.metrics import mean_squared_error as mse

import sklearn.model_selection as model_selection
import sklearn.ensemble as ensemble
import sklearn.linear_model as linear_model
from datetime import datetime

def getData(parkingID):
    mydb = mysql.connector.connect(
        host="localhost",
		user="ubuntu",
		passwd="epl606",
		database="parking"
    )

    query = "SELECT * FROM data WHERE parking_id = " + str(parkingID) 
    data = pandas.read_sql(query,mydb)
    del data['parking_id']
    mydb.close()
    return data
   
def createAvailabilityGroups(data):
    target=[]
    for i in data['space']:
        if i<0.2:
            target.append(0)
        elif i>=0.2 and i<0.4:
            target.append(0.25)
        elif i>=0.4 and i<0.6:
            target.append(0.5)
        elif i>=0.6 and i<0.8:
            target.append(0.75)
        elif i>=0.8:
           target.append(1)
    
    return target

def evaluate(parkingID):
    dataset = getData(int(parkingID))

    #set targets
    target = pandas.DataFrame()
    target['space'] = dataset['space']
    del dataset['space']
    targets = pandas.DataFrame(MinMaxScaler().fit_transform(target),columns=target.columns)
    targetSet = createAvailabilityGroups(targets)

	# exclude day,date from timestamp and normalize based on 24h
    for x in xrange(0,len(dataset['timestamp'])):
        ts = int(dataset['timestamp'][x])
        h = datetime.utcfromtimestamp(ts).strftime('%H')
        m = datetime.utcfromtimestamp(ts).strftime('%M')
        dataset['timestamp'][x] = str(int(h)*60+int(m))
		
    # create train and test sets       
    trainSet,testSet, trainTarget,testTarget = model_selection.train_test_split(dataset, targetSet, test_size=0.4,random_state=0)
     
	# Spot Check Algorithms
    models = []

    models.append(('RandomForest', ensemble.RandomForestRegressor(n_estimators=100, random_state=0)))

    # evaluate each model in turn


# for each parkingID
evaluate(2)
evaluate(4)
evaluate(5)