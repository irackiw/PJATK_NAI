"""
author: Wojciech Iracki <s13066@pjwstk.edu.pl>
task: https://www.codingame.com/training/easy/power-of-thor-episode-1
"""

# light_x: the X position of the light of power
# light_y: the Y position of the light of power
# initial_tx: Thor's starting X position
# initial_ty: Thor's starting Y position
light_x, light_y, initial_tx, initial_ty = [int(i) for i in input().split()]

# game loop
while True:
    remaining_turns = int(input())  # The remaining amount of turns Thor can move. Do not remove this line.
    x = ""  # X position
    y = ""  # Y position

    # conditions checking correct position
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

    print(y + x)  # print results
