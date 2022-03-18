# Inheritance Objects

Small quick project to play with the inheritance and how to set it up in Symfony.

Act as a playground and also as a history tool

_(No Migration file existing as tested only with sqlite... ;-))_

## Goal of the project

Setup a small entity like the following:

* A Survey has multiple Questions
* Questions can be of different sort
  * TextQuestion : only 1 text answer possible
  * NumberQuestion : only 1 number answer possible
  * MultipleChoiceQuestion : multiple choice to choose from
  * BooleanQuestion : only Yes or No possibility

All Questions entities inherit from Question structure  

* Answers can be of different sort
  * TextAnswer
  * NumberAnswer
  * BooleanAnswer
  * MultipleChoiceSingleValueAnswer
  * MultipleChoiceMultipleValueAnswer (_To Be Added_)

All Answers entities inherit from Answer Structure