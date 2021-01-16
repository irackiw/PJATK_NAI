"""
author: Wojciech Iracki <s13066@pjwstk.edu.pl>
task: https://www.codingame.com/training/easy/the-descent
"""

import sys
import math

while True:
    max = 0
    max_index = -1

    for i in range(8):
        mountain_h = int(input())
        if mountain_h > max:
            max = mountain_h
            max_index = i

    print(max_index)
