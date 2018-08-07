training <- read.csv("C:/xampp/htdocs/drugs/backend/web/r/final.csv")
attach(training)
testing <- read.csv("C:/xampp/htdocs/drugs/backend/web/r/final-test.csv")
#testing <- read.csv("C:/Users/user/Documents/kuku/test2.csv")
library(ggplot2); 
library(caret)
colSelection<- c("drug","location", "sold_on", "quantity_purchased", "quantity_sold")
col_names <- c()
n <- ncol(training)-1
for (i in 1:n) {
     if (is.factor(training[,i])){
           col_names <- c(col_names,i)
           }
} 
training <- training[,-col_names]
library(randomForest)
first_seed <- 3457
accuracies <-c()
for (i in 1:6){
       set.seed(first_seed)
       first_seed <- first_seed+1
       trainIndex <- createDataPartition(y=training$keep, p=0.75, list=FALSE)
       trainingSet<- training[trainIndex,]
       testingSet<- training[-trainIndex,]
       modelFit <- randomForest(keep ~., data = trainingSet)
       prediction <- predict(modelFit, testingSet)
       testingSet$rightPred <- prediction == testingSet$keep
       t<-table(prediction, testingSet$keep)
       #print(t)
       accuracy <- sum(testingSet$rightPred)/nrow(testingSet)
       accuracies <- c(accuracies,accuracy)
       #print(accuracy)
}
modelFit <- randomForest(keep ~., data = training)
nrow(testing)
prediction <- predict(modelFit, testing)
output <- c("output=",prediction)
prediction