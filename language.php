<?php

require_once 'db_connection.php';



if (isset($_POST['query'])) {
    $inputText = $_POST['query'];
    $stmt = $mysqli->prepare("SELECT `language-name`, `language-id`, `language-scope`, `language-type` FROM `language` WHERE `language-name` LIKE ? OR `language-id` LIKE ? LIMIT 10");
    $stmt->bind_param('ss', $languageName, $languageID);
    $languageName = '%' . $inputText . '%';
    $languageID = '%' . $inputText . '%';
    $stmt->execute();
    $result = $stmt->get_result();

    $condition = preg_replace('/\s+/', '', $inputText);
    $replace_string = '<b>' . $condition . '</b>';

    if ($result) {
        $foundResults = false;
        while ($row = $result->fetch_assoc()) {
            $languageID = $row['language-id'];
            $languageName = $row['language-name'];
            $languageScope = $row['language-scope'];
            $languageType = $row['language-type'];

            // Bold the matched text
            $boldLanguageName = preg_replace('/' . preg_quote($inputText, '/') . '/i', '<b>$0</b>', $languageName);

            echo '<a class="list-group-item list-group-item-action border-1" onclick="fetchLanguageData(\'' . $languageID . '\')">' . $boldLanguageName . '</a>';
            $foundResults = true;
        }

        if (!$foundResults) {
            echo '<p class="list-group-item border-1">No Language Found</p>';
        }
    } else {
        echo '<p class="list-group-item border-1">No Language Found</p>';
    }
} elseif (isset($_POST['language'])) {
    $selectedLanguage = $_POST['language'];
    $stmt = $mysqli->prepare("SELECT `language-id`, `language-name`, `language-scope`, `language-type` FROM `language` WHERE `language-id` = ? OR `language-name` = ?");
    $stmt->bind_param('ss', $selectedLanguage, $selectedLanguage);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $languageID = $row['language-id'];
        $languageName = $row['language-name'];
        $languageScope = getFullScopeName($row['language-scope']);
        $languageType = getFullTypeName($row['language-type']);

        // Generate HTML code with the fetched data
        $html = '<div class="w3-container language-info" style="display: none;">';
        $html .= '<table class="language-table">';
        $html .= '<thead>';
        $html .= '<tr>';
        $html .= '<td rowspan="3" class="language-code-cell"><h1 class="language-code">' . $languageID . '</h1>ISO639-3 code</td>';
        $html .= '<td class="language-name-cell"><h3 class="language-name">' . $languageName . '</h3></td>';
        $html .= '</tr>';
        $html .= '<tr>';
        $html .= '<td class="language-scope-cell"><h3 class="language-scope">' . $languageScope . '</h3></td>';
        $html .= '</tr>';
        $html .= '<tr>';
        $html .= '<td class="language-type-cell"><h3 class="language-type">' . $languageType . '</h3></td>';
        $html .= '</tr>';
        $html .= '</thead>';
        $html .= '</table>';
        $html .= '</div>';
        

        echo $html;
    } else {
        echo '<p class="list-group-item border-1">No Language Found</p>';
    }
}

function getFullScopeName($scopeAbbreviation) {
    switch ($scopeAbbreviation) {
        case 'I':
            return 'Individual';
        case 'M':
            return 'Macrolanguage';
        case 'S':
            return 'Special';
        default:
            return 'Unknown';
    }
}

function getFullTypeName($typeAbbreviation) {
    switch ($typeAbbreviation) {
        case 'A':
            return 'Ancient';
        case 'C':
            return 'Constructed';
        case 'E':
            return 'Extinct';
        case 'H':
            return 'Historical';
        case 'L':
            return 'Living';
        case 'S':
            return 'Special';
        default:
            return 'Unknown';
    }
}
?>
