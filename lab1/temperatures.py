"""
author: Wojciech Iracki <s13066@pjwstk.edu.pl>
task: https://www.codingame.com/ide/puzzle/chuck-norris
"""

MESSAGE = input()  # Read input.
BINARY = ''  # Convert input message to binary representation.
for i in range(len(MESSAGE)):
    charInBinary = str(bin(ord(MESSAGE[i])))[2:]
    charInBinary = charInBinary.zfill(7)  # Fill binary representation with zeroes to get 7 bit.
    BINARY += charInBinary

lastChar = ' '  # Convert binary representation in "Chuck Norris Code".
codedMessage = ''
encodedBits = [' 00 0', ' 0 0']

# For loop over binary
for i in range(len(BINARY)):
    if BINARY[i] != lastChar:
        lastChar = BINARY[i]
        codedMessage += encodedBits[ord(lastChar) - ord('0')]  # codding  char
    else:
        codedMessage += '0'  # coding last char

print(codedMessage[1:])  # Print encoded message.
