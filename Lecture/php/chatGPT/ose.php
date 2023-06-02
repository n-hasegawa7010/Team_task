<?php

// 盤面のサイズ
$size = 8;

// 盤面の初期化
$board = array_fill(0, $size, array_fill(0, $size, '-'));

// 初期配置
$board[3][3] = 'O';
$board[3][4] = 'X';
$board[4][3] = 'X';
$board[4][4] = 'O';

// 石の置く場所の表示
function displayValidMoves($board, $player) {
    echo "Valid moves for $player: ";
    for ($i = 0; $i < count($board); $i++) {
        for ($j = 0; $j < count($board[$i]); $j++) {
            if ($board[$i][$j] === '-') {
                if (isValidMove($board, $i, $j, $player)) {
                    echo "($i,$j) ";
                }
            }
        }
    }
    echo "\n";
}

// 石の置ける場所の判定
function isValidMove($board, $row, $col, $player) {
    $opponent = ($player === 'X') ? 'O' : 'X';

    // 空白でない場所は無効
    if ($board[$row][$col] !== '-') {
        return false;
    }

    // 上方向
    $r = $row - 1;
    while ($r >= 0 && $board[$r][$col] === $opponent) {
        $r--;
    }
    if ($r >= 0 && $board[$r][$col] === $player && $row - $r > 1) {
        return true;
    }

    // 下方向
    $r = $row + 1;
    while ($r < count($board) && $board[$r][$col] === $opponent) {
        $r++;
    }
    if ($r < count($board) && $board[$r][$col] === $player && $r - $row > 1) {
        return true;
    }

    // 左方向
    $c = $col - 1;
    while ($c >= 0 && $board[$row][$c] === $opponent) {
        $c--;
    }
    if ($c >= 0 && $board[$row][$c] === $player && $col - $c > 1) {
        return true;
    }

    // 右方向
    $c = $col + 1;
    while ($c < count($board[$row]) && $board[$row][$c] === $opponent) {
        $c++;
    }
    if ($c < count($board[$row]) && $board[$row][$c] === $player && $c - $col > 1) {
        return true;
    }

    // 左上方向
    $r = $row - 1;
    $c = $col - 1;
    while ($r >= 0 && $c >= 0 && $board[$r][$c] === $opponent) {
        $r--;
        $c--;
    }
    if ($r >= 0 && $c >= 0 && $board[$r][$c] === $player && $row - $r > 1) {
        return true;
    }

    // 右上方向
    $r = $row - 1;
    $c = $col + 1;
    while ($r >= 0 && $c < count($board[$row]) && $board[$r][$c] === $opponent) {
        $r--;
        $c++;
    }
    if ($r >= 0 && $c < count($board[$row]) && $board[$r][$c] === $player && $row - $r > 1) {
        return true;
    }

    // 左下方向
    $r = $row + 1;
    $c = $col - 1;
    while ($r < count($board) && $c >= 0 && $board[$r][$c] === $opponent) {
        $r++;
        $c--;
    }
    if ($r < count($board) && $c >= 0 && $board[$r][$c] === $player && $r - $row > 1) {
        return true;
    }

    // 右下方向
    $r = $row + 1;
    $c = $col + 1;
    while ($r < count($board) && $c < count($board[$row]) && $board[$r][$c] === $opponent) {
        $r++;
        $c++;
    }
    if ($r < count($board) && $c < count($board[$row]) && $board[$r][$c] === $player && $r - $row > 1) {
        return true;
    }

    return false;
}

// 石をひっくり返す
function flipStones($board, $row, $col, $player) {
    $opponent = ($player === 'X') ? 'O' : 'X';

    // 上方向
    $r = $row - 1;
    while ($r >= 0 && $board[$r][$col] === $opponent) {
        $r--;
    }
    if ($r >= 0 && $board[$r][$col] === $player) {
        for ($i = $row - 1; $i > $r; $i--) {
            $board[$i][$col] = $player;
        }
    }

    // 下方向
    $r = $row + 1;
    while ($r < count($board) && $board[$r][$col] === $opponent) {
        $r++;
    }
    if ($r < count($board) && $board[$r][$col] === $player) {
        for ($i = $row + 1; $i < $r; $i++) {
            $board[$i][$col] = $player;
        }
    }

    // 左方向
    $c = $col - 1;
    while ($c >= 0 && $board[$row][$c] === $opponent) {
        $c--;
    }
    if ($c >= 0 && $board[$row][$c] === $player) {
        for ($i = $col - 1; $i > $c; $i--) {
            $board[$row][$i] = $player;
        }
    }

    // 右方向
    $c = $col + 1;
    while ($c < count($board[$row]) && $board[$row][$c] === $opponent) {
        $c++;
    }
    if ($c < count($board[$row]) && $board[$row][$c] === $player) {
        for ($i = $col + 1; $i < $c; $i++) {
            $board[$row][$i] = $player;
        }
    }

    // 左上方向
    $r = $row - 1;
    $c = $col - 1;
    while ($r >= 0 && $c >= 0 && $board[$r][$c] === $opponent) {
        $r--;
        $c--;
    }
    if ($r >= 0 && $c >= 0 && $board[$r][$c] === $player) {
        $i = $row - 1;
        $j = $col - 1;
        while ($i > $r && $j > $c) {
            $board[$i][$j] = $player;
            $i--;
            $j--;
        }
    }

    // 右上方向
    $r = $row - 1;
    $c = $col + 1;
    while ($r >= 0 && $c < count($board[$row]) && $board[$r][$c] === $opponent) {
        $r--;
        $c++;
    }
    if ($r >= 0 && $c < count($board[$row]) && $board[$r][$c] === $player) {
        $i = $row - 1;
        $j = $col + 1;
        while ($i > $r && $j < $c) {
            $board[$i][$j] = $player;
            $i--;
            $j++;
        }
    }

    // 左下方向
    $r = $row + 1;
    $c = $col - 1;
    while ($r < count($board) && $c >= 0 && $board[$r][$c] === $opponent) {
        $r++;
        $c--;
    }
    if ($r < count($board) && $c >= 0 && $board[$r][$c] === $player) {
        $i = $row + 1;
        $j = $col - 1;
        while ($i < $r && $j > $c) {
            $board[$i][$j] = $player;
            $i++;
            $j--;
        }
    }

    // 右下方向
    $r = $row + 1;
    $c = $col + 1;
    while ($r < count($board) && $c < count($board[$row]) && $board[$r][$c] === $opponent) {
        $r++;
        $c++;
    }
    if ($r < count($board) && $c < count($board[$row]) && $board[$r][$c] === $player) {
        $i = $row + 1;
        $j = $col + 1;
        while ($i < $r && $j < $c) {
            $board[$i][$j] = $player;
            $i++;
            $j++;
        }
    }

    return $board;
}

// 盤面の表示
function displayBoard($board) {
    echo "   ";
    for ($i = 0; $i < count($board); $i++) {
        echo " $i ";
    }
    echo "\n";
    for ($i = 0; $i < count($board); $i++) {
        echo " $i ";
        for ($j = 0; $j < count($board[$i]); $j++) {
            echo " " . $board[$i][$j] . " ";
        }
        echo "\n";
    }
}

// ゲームの進行
function playGame() {
    $board = $GLOBALS['board'];
    $size = $GLOBALS['size'];
    $currentPlayer = 'X';

    while (true) {
        displayBoard($board);
        displayValidMoves($board, $currentPlayer);

        echo "Player $currentPlayer's turn. Enter row and column: ";
        $input = trim(fgets(STDIN));
        $move = explode(',', $input);
        $row = intval($move[0]);
        $col = intval($move[1]);

        if (isValidMove($board, $row, $col, $currentPlayer)) {
            $board[$row][$col] = $currentPlayer;
            $board = flipStones($board, $row, $col, $currentPlayer);
            $currentPlayer = ($currentPlayer === 'X') ? 'O' : 'X';
        } else {
            echo "Invalid move. Try again.\n";
        }

        // ゲーム終了条件
        $gameOver = true;
        for ($i = 0; $i < $size; $i++) {
            for ($j = 0; $j < $size; $j++) {
                if ($board[$i][$j] === '-') {
                    if (isValidMove($board, $i, $j, 'X') || isValidMove($board, $i, $j, 'O')) {
                        $gameOver = false;
                        break 2;
                    }
                }
            }
        }

        if ($gameOver) {
            break;
        }
    }

    displayBoard($board);
    echo "Game over!\n";
    $countX = 0;
    $countO = 0;
    for ($i = 0; $i < $size; $i++) {
        for ($j = 0; $j < $size; $j++) {
            if ($board[$i][$j] === 'X') {
                $countX++;
            } elseif ($board[$i][$j] === 'O') {
                $countO++;
            }
        }
    }
    echo "X: $countX, O: $countO\n";
    if ($countX > $countO) {
        echo "Player X wins!\n";
    } elseif ($countX < $countO) {
        echo "Player O wins!\n";
    } else {
        echo "It's a draw!\n";
    }
}

playGame();

?>
