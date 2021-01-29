"""
author: Wojciech Iracki <s13066@pjwstk.edu.pl>
task: https://www.codingame.com/training/easy/the-descent
"""

# game loop
while True:
    max = 0  # max height variable
    max_index = -1  # max index iterator

    for i in range(8):
        mountain_h = int(input())  # represents the height of one mountain.
        if mountain_h > max:
            max = mountain_h # set max height variable
            max_index = i  # increase max index

    print(max_index)  # print the index of the mountain to fire on.
