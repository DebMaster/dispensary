training <- read.csv("C:\xampp\htdocs\drugs\backend\web\r\final.csv")
attach(training) #attaching data frame to reduce the length of the variable names associated to it
testing <- read.csv("C:\xampp\htdocs\drugs\backend\web\r\new-test2.csv")
print("------------------Attributes ----------------------------")
tail(names(training),24)
print("------------------ LABEL ------------------------------ ")
summary(training$keep)
print("-------------------RESULTS-------------------------------")





library(ggplot2); 
library(caret)
## Loading required package: lattice
#selecting a few of the more promising predictors to be plotted
colSelection<- c("drug","location", "sold_on", "quantity_purchased", "quantity_sold")
#creating a feature plot 
featurePlot(x=training[,colSelection],y = training$keep,plot="drugs")

print("-------------------------LETS PRINT A HISTOGRAM OF TWO ATTRIBUTES AGAINST OUR CLASS LABEL")

par(mfrow=c(1,2))
hist(quantity_purchased, main = "quantity_purchased")
hist(quantity_sold, main="quantity_sold")


#lets remove csv headers
#training <- training[,-c(1,2,3,4,5,6)]

#remove all the columns with missing values from the dataset:
#training <-training[,colSums(is.na(training))==0]

#find all the columns that are factors, while ignoring the last column which was the response variable "keep."


col_names <- c()
n <- ncol(training)-1
for (i in 1:n) {
     if (is.factor(training[,i])){
           col_names <- c(col_names,i)
           }
}
 
#remove these columns from the data frame, since some of the machine learning algorithms cannot work with factor variables that have over 32 levels.
training <- training[,-col_names]


#Cross Validation Using Random Subsampling and Random Forest
library(randomForest)
first_seed <- 3457
accuracies <-c()
for (i in 1:3){
       set.seed(first_seed)
       first_seed <- first_seed+1
       trainIndex <- createDataPartition(y=training$keep, p=0.75, list=FALSE)
       trainingSet<- training[trainIndex,]
       testingSet<- training[-trainIndex,]
       modelFit <- randomForest(keep ~., data = trainingSet)
       prediction <- predict(modelFit, testingSet)
       testingSet$rightPred <- prediction == testingSet$keep
       t<-table(prediction, testingSet$keep)
       print(t)
       accuracy <- sum(testingSet$rightPred)/nrow(testingSet)
       accuracies <- c(accuracies,accuracy)
       print(accuracy)
}

modelFit <- randomForest(keep ~., data = training)
nrow(testing)
## [1] 500
prediction <- predict(modelFit, testing)
prediction