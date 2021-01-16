"""
author: Wojciech Iracki <s13066@pjwstk.edu.pl>
task: https://www.codingame.com/training/easy/power-of-thor-episode-1"""


light_x, light_y, initial_tx, initial_ty = [int(i) for i in input().split()]

while True:
    remaining_turns = int(input())
    x = ""
    y = ""

    if initial_ty > light_y:
        y += "N"
        initial_ty -= 1
    elif initial_ty < light_y:
        y += "S"
        initial_ty += 1
    if initial_tx > light_x:
        x += "W"
        initial_tx += 1
    elif initial_tx < light_x:
        x += "E"
        initial_tx -= 1

    print(y + x)
