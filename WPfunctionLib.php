<?php
// MARK: カスタム投稿タイプでカテゴリ未選択時にデフォルトのタームを設定
function add_defaultcategory_automatically($post_ID) {
    global $wpdb;
    // カテゴリorタグのID
    $MyTaxonomyID = 'hogehoge-cat';
    // 自動付与したいタームID（該当タグのページのURLの&tag_ID=xxxの値）
    $MyTermID = 1234;

    $curTerm = wp_get_object_terms($post_ID, $MyTaxonomyID);
    if (0 == count($curTerm)) {
        $defaultTerm = array($MyTermID);
        wp_set_object_terms($post_ID, $defaultTerm, $MyTaxonomyID);
    }
}
// publish_post_type | post_type部分を変更
add_action('publish_hogehoge', 'add_defaultcategory_automatically');


// MARK: 「x件中 / n-m 件表示」のパーツ
global $wp_query;
$perPage = POSTSPERPAGE; // 本体で表示している記事数
$nowPage = get_query_var('paged');
$allPageNum = $wp_query->found_posts;
$startPageNum = ($perPage * ($nowPage - 1)) + 1;
$endPageNum = ($perPage * $nowPage);
if($endPageNum > $allPageNum) {
    $endPageNum = $allPageNum;
}
echo $allPageNum . ' 件中 / ' . $startPageNum . '-' . $endPageNum . ' 件表示';
