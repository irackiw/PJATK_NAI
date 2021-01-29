"""
author: Wojciech Iracki <s13066@pjwstk.edu.pl>, Adrian Wojewoda <s16095@pjwstk.edu.pl>
task: The game of Connect Four, as described here: http://en.wikipedia.org/wiki/Connect_Four
"""

# Check numpy installed in try-catch
try:
    import numpy as np
    from easyAI import TwoPlayersGame

except ImportError:
    print("One of the import not installed.")
    raise


class ConnectFour(TwoPlayersGame):

    def __init__(self, players, board=None):
        self.players = players
        self.board = board if (board is not None) else (  # board generating
            np.array([[0 for i in range(7)] for j in range(6)]))
        self.nplayer = 1  # player 1 starts.

    # get possible moves
    def possible_moves(self):
        return [i for i in range(7) if (self.board[:, i].min() == 0)]

    # make a move on board
    def make_move(self, column):
        line = np.argmin(self.board[:, column] != 0)
        self.board[line, column] = self.nplayer

    # print board
    def show(self):
        print('\n' + '\n'.join(
            ['0 1 2 3 4 5 6', 13 * '-'] +
            [' '.join([['.', 'O', 'X'][self.board[5 - j][i]]
                       for i in range(7)]) for j in range(6)]))

    def lose(self):
        return find_four(self.board, self.nopponent)

    # end of the game
    def is_over(self):
        return (self.board.min() > 0) or self.lose()

    # add score & check is lose
    def scoring(self):
        return -100 if self.lose() else 0


# returns true if the player has connected 4 (or more)
def find_four(board, nplayer):
    for pos, direction in POS_DIR:
        streak = 0
        while (0 <= pos[0] <= 5) and (0 <= pos[1] <= 6):
            if board[pos[0], pos[1]] == nplayer:
                streak += 1
                if streak == 4:
                    return True
            else:
                streak = 0
            pos = pos + direction
    return False


# Generate positions array
POS_DIR = np.array([[[i, 0], [0, 1]] for i in range(6)] +
                   [[[0, i], [1, 0]] for i in range(7)] +
                   [[[i, 0], [1, 1]] for i in range(1, 3)] +
                   [[[0, i], [1, 1]] for i in range(4)] +
                   [[[i, 6], [1, -1]] for i in range(1, 3)] +
                   [[[0, i], [1, -1]] for i in range(3, 7)])

if __name__ == '__main__':

    from easyAI import Human_Player, AI_Player, Negamax, SSS, DUAL

    ai_algo_neg = Negamax(5)
    ai_algo_sss = SSS(5)
    game = ConnectFour([AI_Player(ai_algo_neg), Human_Player()])
    game.play()
    if game.lose():
        print("Player %d wins." % (game.nopponent))
    else:
        print("Looks like we have a draw.")
