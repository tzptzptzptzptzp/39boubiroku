<?php get_header(); ?>

<style>
    .category-content {
        display: none;
    }
    .category-content.active {
        display: block;
    }
    .u-home-post-item {
        box-shadow: 0px 1px 3px rgba(0, 0, 0, .25), 0px 1px 2px rgba(0, 0, 0, .25), 6px 12px 3px 0px rgba(0, 0, 0, 0.03), 20px 20px 5px 0px rgba(0, 0, 0, 0.03);
    }
    .u-home-post-item .u-home-post-item__overlay, .u-home-post-item .u-home-post-item__description {
        transition-duration: 300ms;
    }
    .u-home-post-item .u-home-post-item__overlay {
        opacity: 0;
    }
    .u-home-post-item:hover .u-home-post-item__overlay {
        opacity: 0.5;
    }
    .u-home-post-item .u-home-post-item__description {
        transform: translateY(25%);
        opacity: 0;
    }
    .u-home-post-item:hover .u-home-post-item__description {
        transform: translateY(0);
        opacity: 1;
    }
</style>

<div class="flex items-center justify-center min-h-dvh w-full">

    <?php
    // 取得したいカテゴリー配列
    $categories = ['money', 'idea', 'health', 'item'];

    // 各カテゴリーごとの投稿を格納する配列
    $category_posts = [];

    // 各カテゴリーの投稿を7件ずつ取得
    foreach ($categories as $category) {
      $category_posts[$category] = get_posts([
        'category_name' => $category,
        'numberposts' => 7,
        'post_status' => 'publish',
      ]);
    }
    ?>

    <?php foreach ($categories as $category): ?>
        <div data-category-selector-contents="<?php echo esc_attr(
          $category,
        ); ?>" class="category-content w-[88vw] max-w-[1280px]">
            <div class="grid grid-cols-4 gap-x-4 gap-y-40 w-full p-4">
                <?php if (!empty($category_posts[$category])):
                  foreach ($category_posts[$category] as $post):
                    setup_postdata($post); ?>
                    <a href="<?php echo get_permalink(
                      $post,
                    ); ?>" class="u-home-post-item overflow-hidden p-2 bg-white">
                        <div class="relative mb-1">
                            <?php if (has_post_thumbnail($post->ID)): ?>
                                <img class="w-full h-full object-cover aspect-video" src="<?php the_post_thumbnail_url(
                                  'medium',
                                ); ?>" alt="サムネイル画像：<?php echo get_the_title($post); ?>" />
                            <?php else: ?>
                                <div class="w-full h-full bg-gray-200 flex items-center justify-center aspect-video">
                                    <p class="text-gray-400">no image</p>
                                </div>
                            <?php endif; ?>
                            <div class="absolute inset-0 overflow-hidden p-1">
                                <div class="u-home-post-item__overlay absolute inset-0 w-full h-full bg-black"></div>
                                <div class="u-home-post-item__description relative">
                                    <p class="text-white">
                                        <?php echo wp_trim_words(
                                          get_the_excerpt($post),
                                          120,
                                          '...',
                                        ); ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <h3 class="u-home-post-item__title line-clamp-2 text-base overflow-hidden"><?php echo get_the_title(
                          $post,
                        ); ?></h3>
                        <div class="u-home-post-item__meta flex items-center justify-between gap-2">
                            <p class="u-home-post-item__tags text-xs line-clamp-1 overflow-hidden">
                                <?php
                                $posttags = get_the_tags();
                                if ($posttags) {
                                  foreach ($posttags as $tag) {
                                    echo $tag->name . ' ';
                                  }
                                }
                                ?>
                            </p>
                            <time class="u-home-post-item__time min-w-fit text-xs whitespace-nowrap"><?php the_time(
                              'y/m/d',
                            ); ?></time>
                        </div>
                    </a>
                <?php
                  endforeach;
                  wp_reset_postdata();
                endif; ?>
            </div>
        </div>
    <?php endforeach; ?>

</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // カテゴリーボタンのイベントリスナーを設定
    const categoryButtons = document.querySelectorAll('[data-category-selector]');
    const categoryContents = document.querySelectorAll('[data-category-selector-contents]');
    
    // デフォルトで最初のカテゴリー(idea)を表示
    const defaultCategory = document.querySelector('[data-category-selector-contents="idea"]');
    if (defaultCategory) {
        defaultCategory.classList.add('active');
    }
    
    categoryButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            const category = this.getAttribute('data-category-selector');
            
            // すべてのコンテンツからactiveクラスを削除
            categoryContents.forEach(function(content) {
                content.classList.remove('active');
            });
            
            // 選択されたカテゴリーのコンテンツにactiveクラスを追加
            const targetContent = document.querySelector('[data-category-selector-contents="' + category + '"]');
            if (targetContent) {
                targetContent.classList.add('active');
            }
        });
    });
});
</script>

<?php get_footer(); ?>
