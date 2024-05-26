<?genheader("사칙연산 게임 제작", "June 13, 2023");?>

        <link rel="stylesheet" href="style.css" />
        <script src="script.js" type="text/javascript" defer></script>
        <div id="doc_wrapper">
            <div id="header_row">
                <div>
                    <a href="/" class="title">
                        <b>+ - × ÷</b>
                    </a>
                </div>
                <div>
                    <a class="title" href="/game/hall_of_fame.php">HALL OF FAME</a>
                </div>
            </div>
            <div id="edit_row">
                <label for="name">Name (1 to 8 characters):</label>
                <input type="text" id="name" name="name" required
                        minlength="1" maxlength="8" size="10">
            </div>            
            <div id="num_row">
                <div class="dummy"></div>
                <div class="num" id="col0">9</div>
                <div class="op" id="col1">+</div>
                <div class="num" id="col2">9</div>
                <div class="op" id="col3">-</div>
                <div class="num" id="col4">1</div>
                <div class="dummy"></div>
            </div>
            <div id="output_wrapper">
                <h1 id="score"></h1>
                <p id="rank_desc"></p>
            </div>
            <div id="button_wrapper">
                <button id="retry">Retry</button>
            </div>
        </div>

