<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>htmlLib</title>
</head>
<body>
    <?php // MARK: WordPressから最新記事を取得し表示する ?>
    <section class="info">
            <div class="wrap w850">
                <div class="info-box">
                    <h2 class="info-head flex vcenter">最新情報<span class="sub">information</span></h2>
                    <div class="info-body">
                        <ul class="list">
                            <?php
                            $query = array(  //クエリー初期設定
                            'post_type'      => 'hogehoge',          //投稿タイプ
                            'post_status'    => 'publish',        //公開済みの記事
                            'posts_per_page' => 3,            //出力数　-1で全件
                            'order'          => 'DESC',          //降順ソート
                            'orderby'        => 'date',          //投稿日でソート
                            );
                            $query = new WP_Query($query);
                            ?>
                            <?php if($query -> have_posts())://冒頭の処理 ?>
                            <?php while($query -> have_posts()): $query -> the_post(); ?>

                            <li class="flex vstart break">
                                <div class="date"><time datetime="<?php the_time('Y-m-d'); ?>"><?php the_time('Y.m.d'); ?></time></div>
                                <div class="cat">
                                    <?php //投稿のターム情報取得
                                    $tax_slug = 'p-cat';  //タクソノミースラッグ
                                    $terms = get_the_terms(get_the_ID(),$tax_slug);  //タクソノミー取得
                                    $term = $terms[0];  //先頭のタームをセット
                                    ?>
                                    <?php echo $term -> name; ?>
                                </div>
                                <div class="text">
                                    <?php if(get_the_title()): ?>
                                    <?php the_title(); ?>
                                    <?php else: ?>
                                    <?php the_content(); ?>
                                    <?php endif; ?>
                                </div>
                            </li>
                            <?php endwhile;//最後の処理 ?>
                            <?php endif; wp_reset_postdata();//処理終了 ?>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
</body>
</html>