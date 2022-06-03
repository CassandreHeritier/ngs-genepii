setwd("/Users/heritiertellierca/Desktop/Stage-HCL/emergen")
# install.packages("readxl")
# install.packages("tidyverse")
library("readxl")
library("tidyverse")

## EMERGEN format given
olddata <- read_excel("./emergen_theophile.xlsx", skip = 5, col_names = FALSE)
colnames(olddata) <- olddata[1,] # rename columns
olddata <- olddata[-1,] # remove first row
olddata <- olddata[!is.na(olddata$`Num�ro de pr�l�vement`),] # keep only rows with a sample id

# Keep all without missing columns (filled with NA)
allmisscols_old <- sapply(olddata, function(x) all(is.na(x))) # get missing columns names by logical
for (i in 1:length(allmisscols_old)){
  if (allmisscols_old[i]){
    misscol <- names(allmisscols_old)[i]
    olddata <- olddata[, which(names(olddata) != misscol)] 
  }
}

## My EMERGEN format
newdata <- read.csv("./emergen_cassandre.csv")[,-1]

# Keep all without missing columns (filled with NA)
allmisscols_new <- sapply(newdata, function(x) all(is.na(x))) # get missing columns names by logical
for (i in 1:length(allmisscols_new)){
  if (allmisscols_new[i]){
    misscol <- names(allmisscols_new)[i]
    newdata <- newdata[, which(names(newdata) != misscol)] 
  }
}

# Restablish 0 at the begin of samples id
for (sample in newdata$id_sample){
  if (!is.na(sample) && startsWith(as.character(sample), '2')){
    newdata$id_sample[newdata$id_sample == sample] <- paste(0, sample, sep = '')
  }
}

## Compare dataframes
# Corres file for columns names
corres <- read.csv("./EMERGEN-0.0.1.csv", encoding = "UTF-8")

# Rename with names of my emergen
for (col in colnames(olddata)){
  if (col %in% corres$emergen_cols){
    newname <- corres$db_cols[corres$emergen_cols == col]
    if (newname != ''){
      names(olddata)[names(olddata) == col] <- newname
    }
  }
}

# Keep my columns only
olddata <- olddata[colnames(newdata)]

# Convert integers into strings into my data (str(DF) to know which types are)
numcols <- unlist(lapply(newdata, is.numeric)) # get numeric column names
newdata[,numcols] <- lapply(newdata[,numcols], as.character) # convert

# Get different rows between the both dataframes
common <- inner_join(newdata, olddata) # all common data between old and new data
diff_newdata <- setdiff(newdata, common) # specific in new data
diff_olddata <- setdiff(olddata, common) # specific in old data
diff_all <- merge(diff_newdata, diff_olddata, 'id_sample', suffixes = c('.CH', '.TH')) # merge columns based on id sample
colnames <- data.frame(colnames(common))[-1,] # get column names into DF except id_sample

final_list <- list()

for (col in colnames){ # loop on column names
  col_newdata <- paste(col, '.CH', sep = '')
  col_olddata <- paste(col, '.TH', sep = '')
  
  all <- diff_all[c('id_sample', col_newdata, col_olddata)] # concatenate concerned columns into a new DF
  col_common <- inner_join(diff_newdata[c('id_sample', col)], diff_olddata[c('id_sample', col)], 'id_sample')
  col_diff <- all[all[col_newdata] != all[col_olddata],]
  
  if (dim(col_diff)[1] != 0) {
    write.csv(col_diff, paste('./compare/', col, '.csv', sep = ''))
    final_list[[col]] <- col_diff 
  }
}

# Vizualise dataframes of differences
View(final_list$department_sender)