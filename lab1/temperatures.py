"""
author: Wojciech Iracki <s13066@pjwstk.edu.pl>
task: https://www.codingame.com/ide/puzzle/chuck-norris
"""

MESSAGE = input()
BINARY = ''

for i in range(len(MESSAGE)):
    charInBinary = str(bin(ord(MESSAGE[i])))[2:]
    charInBinary = charInBinary.zfill(7)
    BINARY += charInBinary

lastChar = ' '
codedMessage = ''
encodedBits = [' 00 0', ' 0 0']

for i in range(len(BINARY)):
    if BINARY[i] != lastChar:
        lastChar = BINARY[i]
        codedMessage += encodedBits[ord(lastChar) - ord('0')]
    else:
        codedMessage += '0'

print(codedMessage[1:])