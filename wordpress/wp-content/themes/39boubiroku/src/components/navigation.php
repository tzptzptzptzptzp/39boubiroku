<style>
    [data-category-selector].active {
        opacity: 1;
    }
</style>

<nav>
    <ul class="flex justify-around items-center">
        <li>
            <button data-category-selector="money" class="cursor-pointer duration-300 opacity-30 hover:opacity-100 hover:scale-x-110">
                <?php get_template_part('src/logos/money'); ?>
            </button>
        </li>
        <li>
            <button data-category-selector="idea" class="cursor-pointer duration-300 opacity-30 hover:opacity-100 hover:scale-x-110 active">
                <?php get_template_part('src/logos/idea'); ?>
            </button>
        </li>
        <li>
            <a href="/" class="block -translate-y-0.5 duration-300 hover:scale-x-105">
                <?php get_template_part('src/logos/39boubiroku'); ?>
            </a>
        </li>
        <li>
            <button data-category-selector="health" class="cursor-pointer duration-300 opacity-30 hover:opacity-100 hover:scale-x-110">
                <?php get_template_part('src/logos/health'); ?>
            </button>
        </li>
        <li>
            <button data-category-selector="item" class="cursor-pointer duration-300 opacity-30 hover:opacity-100 hover:scale-x-110">
                <?php get_template_part('src/logos/item'); ?>
            </button>
        </li>
    </ul>
</nav>

<script>
document.addEventListener('DOMContentLoaded', function() {
  const categoryButtons = document.querySelectorAll('[data-category-selector]');
  
  categoryButtons.forEach(function(button) {
    button.addEventListener('click', function() {
      categoryButtons.forEach(function(btn) {
        btn.classList.remove('active');
      });
      
      this.classList.add('active');
    });
  });
});
</script>
