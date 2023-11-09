

from scipy.spatial.distance import cosine
import PyPDF2

import sys
from PyPDF2 import PdfReader
# Load the pre-trained SBERT model
from sentence_transformers import SentenceTransformer, util
import numpy as np

model = SentenceTransformer('stsb-roberta-large')

# Actual Evaluation using Transformers
def score(sentence1,sentencepython):
    embedding1 = model.encode(sentence1, convert_to_tensor=True)
    embedding2 = model.encode(sentence2, convert_to_tensor=True)
    # compute similarity scores of two embeddings
    cosine_scores = util.pytorch_cos_sim(embedding1, embedding2)
    sc = cosine_scores.item()
    if sc < 0.4:
      return 0
    elif sc > 0.4 and sc < 0.65:
      return 0.5
    else:
      return 1

# Function to extract text from PDF file
def extract_text_from_pdf(file_path):
    with open(file_path, 'rb') as file:
        reader = PyPDF2.PdfReader(file)
        text = ""
        for page in reader.pages:
            text += page.extract_text()
    return text

# Get file paths from command-line arguments
# model_answers_file_path = sys.argv[1]
# student_answers_file_path = sys.argv[2]

reader1 = PdfReader('uploads/1234_model_answers.pdf')
reader2 = PdfReader('uploads/Rohit.pdf')
# printing number of pages in pdf file

# getting a specific page from the pdf file
page1 = reader1.pages[0] #getting first page
page2 = reader2.pages[0]

# extracting text from page
text1 = page1.extract_text()
text2 = page2.extract_text()

# Extract text from PDF files
def listToString(s):

    # initialize an empty string
    str1 = ""

    # traverse in the string
    for ele in s:
        str1 += ele+" "

    # return string
    return str1




print("Started")
que_mark = [2,2,2,2,2,2,2,2,2]
total = 16
que = 9
textls1 = []
textls2 = []
textls1 = text1.split(" ")
textls2 = text2.split(" ")
sum = 0
with open('output.txt', 'w') as f:

 for i in range(1,que):
    print(" ---------------",file=f)
    print("| Question no. "+str(i)+"|",file=f)
    sent1 = []
    sent2 = []
    mystr = "\n"+"Ans"+str(i)
    if mystr in textls1:
        mystr2 = "\n"+"Ans"+str(i+1)
        ind = textls1.index(mystr)
        for j in range(ind+1,len(textls1)):
            if textls1[j]!=mystr2:
                sent1.append(textls1[j])
            else:
                break
    sentence1 = listToString(sent1)
    print("Student answer"+str(i)+"---> "+sentence1,file=f)
    if mystr in textls2:
        mystr2 = "\n"+"Ans"+str(i+1)
        ind = textls2.index(mystr)
        for j in range(ind+1,len(textls2)):
            if textls2[j]!=mystr2:
                sent2.append(textls2[j])
            else:
                break
    sentence2 = listToString(sent2)
    print("Actual Answer"+str(i)+"---> " +sentence2,file=f)
    print("------------------------------------------------------",file=f)
    mrk = que_mark[i-1]*score(sentence1,sentence2)
    sum = sum+mrk
    print("||Score for this question :-----> "+str(mrk)+"/"+str(que_mark[i-1]),file=f)
    print("------------------------------------------------------",file=f)

    print("\n\n",file=f)
 print("\nTotal score:- "+str(sum)+"/"+str(total),file=f)

#Process the extracted text with SBERT model


# Calculate cosine similarity between model answer and student answer embeddings
