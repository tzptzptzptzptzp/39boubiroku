<?php get_header(); ?>

<div class="flex flex-col items-center justify-center min-h-dvh w-full">

    <?php
    // 取得したいカテゴリー配列
    $categories = array('money', 'idea', 'health', 'item');
    
    // 各カテゴリーごとの投稿を格納する配列
    $category_posts = array();
    
    // 各カテゴリーの投稿を7件ずつ取得
    foreach ($categories as $category) {
        $category_posts[$category] = get_posts(array(
            'category_name' => $category,
            'numberposts' => 7,
            'post_status' => 'publish'
        ));
    }
    ?>

    <?php foreach ($categories as $category) : ?>
        <div id="<?php echo esc_attr($category); ?>-content" class="category-content w-full" style="display: none;">
            <h2 class="text-2xl font-bold text-center my-8"><?php echo ucfirst(esc_html($category)); ?></h2>
            
            <div class="grid grid-cols-4 gap-x-4 gap-y-32 w-full p-4">
                <?php 
                if (!empty($category_posts[$category])) :
                    foreach ($category_posts[$category] as $post) : 
                        setup_postdata($post);
                ?>
                    <div class="item border p-4">
                        <h3 class="font-bold"><?php echo get_the_title($post); ?></h3>
                        <div class="text-sm">
                            <?php echo wp_trim_words(get_the_excerpt($post), 20, '...'); ?>
                        </div>
                        <a href="<?php echo get_permalink($post); ?>" class="text-blue-500 hover:underline">詳細を見る</a>
                    </div>
                <?php 
                    endforeach;
                    wp_reset_postdata();
                else : 
                ?>
                    <div class="col-span-4 text-center py-8">
                        このカテゴリーには投稿がありません。
                    </div>
                <?php endif; ?>
            </div>
        </div>
    <?php endforeach; ?>

</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // カテゴリーボタンのイベントリスナーを設定
    const categoryButtons = document.querySelectorAll('[data-category]');
    const categoryContents = document.querySelectorAll('.category-content');
    
    // デフォルトで最初のカテゴリー(money)を表示
    document.getElementById('money-content').style.display = 'block';
    
    categoryButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            const category = this.getAttribute('data-category');
            
            // すべてのコンテンツを非表示
            categoryContents.forEach(function(content) {
                content.style.display = 'none';
            });
            
            // 選択されたカテゴリーのコンテンツを表示
            const targetContent = document.getElementById(category + '-content');
            if (targetContent) {
                targetContent.style.display = 'block';
            }
        });
    });
});
</script>

<?php get_footer(); ?>
