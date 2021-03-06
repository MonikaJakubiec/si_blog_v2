<?php
function getRandomString($length)
{
    $randomString = '';
    $characters = 'abcdefghijklmnopqrstuvwxyz';
    for ($i = 0; $i < $length; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $randomString .= $characters[$index];
    }
    return $randomString;
}
/**
 * Zwraca tablicę z informacjami o slajderze
 *
 * @param integer $limit  liczba postow na slider
 * @param boolean $random losowa kolejnosc slajdow
 * @param integer $timePerOneSlide czas w sekundach na jeden slajd
 * @param integer $numOfSimultaneousSlides liczba jednoczesnych postow na slajderze
 * @return void
 */
function prepareFeaturedForSLider($limit = 3, $random = false, $timePerOneSlide = 1, $numOfSimultaneousSlides = 1)
{
    require_once(_VIEWS_PATH . DIRECTORY_SEPARATOR . 'partials' . DIRECTORY_SEPARATOR  . 'featured.php');
    require_once(_CLASSES_PATH  . 'Article.php');
    require_once(_REPOSITORIES_PATH  . 'ArticleRepository.php');
    $sliderRandomId = "slider-" . getRandomString(5);
    $articleRepository = new ArticleRepository;
    if ($random)
        $featuredArticles = $articleRepository->getArticles(true, true, $limit, 0, null, array(["random", "asc"]),);
    else
        $featuredArticles = $articleRepository->getArticles(true, true, $limit, 0, null,array(['publishedTime','DESC']));


    $numOfSlides = count($featuredArticles);
    if ($numOfSlides > 0) {
        $keyframesName = "transition-" . $sliderRandomId;

        addToHeadStyle("@keyframes " . $keyframesName . " { ");
        $timeForAllSlides = $numOfSlides * $timePerOneSlide;
        $percentPerSlide = 100 / $numOfSlides; //czas na slajd ze zmiana
        $percentPerTransition = min(5, $percentPerSlide / 3); //5%, ale nie wiecej niż 1/3 dlugosci slajdu
        for ($slideNum = 0; $slideNum <= $numOfSlides - $numOfSimultaneousSlides; $slideNum++) {

            addToHeadStyle(number_format($slideNum * $percentPerSlide, 2, '.', '') . '% {left: ' . number_format((-$slideNum * 100 / $numOfSimultaneousSlides), 2, '.', '') . '%;} ');
            addToHeadStyle(number_format(($slideNum + 1) * $percentPerSlide - $percentPerTransition, 2, '.', '') . '% {left: ' . number_format((-$slideNum * 100 / $numOfSimultaneousSlides), 2, '.', '') . '%;} ');
        }
        $lastOffset = $numOfSlides - $numOfSimultaneousSlides;
        addToHeadStyle("95% {left:" . number_format(- ($lastOffset * 100 / $numOfSimultaneousSlides), 2, '.', '') . "%;}");
        addToHeadStyle("100% {left:0%;}");
        addToHeadStyle(" }");

        addToHeadStyle("#featured-slider .slider#" . $sliderRandomId . " { animation: " . $timeForAllSlides . "s " . $keyframesName . " infinite; }");

        addToHeadStyle("#featured-slider .slider#" . $sliderRandomId . ":hover {animation-play-state: paused;}");
        return array($featuredArticles, $sliderRandomId, $numOfSimultaneousSlides);
    } else
        return null;
}

function getFrontendPath($path)
{
    return str_replace("\\", "/", $path);
}

$stylesToInsertInline = "";
function addToHeadStyle($styleToAdd)
{
    global $stylesToInsertInline;
    $stylesToInsertInline .= $styleToAdd;
}
function renderHeadStyle()
{
    global $stylesToInsertInline;
    if (strlen($stylesToInsertInline) > 0)
        echo "<!--custom style start--><style>" . $stylesToInsertInline . "</style><!--custom style end-->";
}

/**
 * Dodaje alert do tabeli z alertami
 *
 * @param string $wiadomosć wyświetlana
 * @param string $type rodzaj wiadomości (info/warning/success/error)
 * @param boolean $showOnlyInDebugMode wiadomosc zostanie wyświetlona tylko w trybie debugowania
 * @param boolean $backtrace
 * @return void
 */
function addAlert($message, $type = "info", $showOnlyInDebugMode = false, $backtrace = null)
{
    require_once _CLASSES_PATH . DIRECTORY_SEPARATOR . 'Alert.php';
    $newAlert = new Alert($message, $type, $showOnlyInDebugMode, $backtrace);
    if (isset($_SESSION['alerts']))
        $alerts = unserialize($_SESSION['alerts']);
    else
        $alerts = [];
    array_push($alerts, $newAlert);
    $_SESSION['alerts'] = serialize($alerts);
}

function renderAlerts()
{
    if (isset($_SESSION['alerts'])) {
        require_once _CLASSES_PATH . DIRECTORY_SEPARATOR . 'Alert.php';
        $alerts = unserialize($_SESSION['alerts']);
        if (count($alerts) > 0) {
?>
            <div id="alerts">
                <?php
                foreach ($alerts as $index => $alert) {
                    $alert->render($index);
                }
                ?>
            </div>
            <script>
                addAllertCloseButtonListener();
            </script>
<?php
        }
        unset($_SESSION['alerts']);
    }
}


function showNotFoundPage($userRole = null)
{

    $pageNewNotFound = 'page-not-found';
    $actionNewNotFound = _ACTIONS_PATH . $pageNewNotFound . '.php';
    $viewNewNotFound = _VIEWS_PATH . $pageNewNotFound . '.php';
    if (file_exists($actionNewNotFound))
        include($actionNewNotFound);
    if (file_exists($viewNewNotFound))
        include($viewNewNotFound);
    else
        echo "<h1>Nie znaleziono</h1>";
    exit();
}

/**
 * konwersja tekstu na postać bezpieczna do wstawienia do bazy sql
 */
function secureInputText($data)
{
    return htmlentities($data);
}

/**
 * konwersja tekstu na postać bezpieczna do wstawienia do bazy sql
 */
function secureInputTextWithTrimSpaces($data)
{
    $data = trim($data);
    return htmlentities($data);
}
