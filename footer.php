<footer class="footer">
    <div class="inner">
        <?php
        $phones_1 = get_field('phones', 'options');
        $phones_2 = get_field('phones_2', 'options');

        $arr_1 = explode(',', $phones_1);
        $arr_2 = explode(',', $phones_2);

        $address = get_field('address', 'options');
        $arr_3 = explode('<br />', $address);
        ?>
        <p itemtype="schema.org/PostalAddress" itemscope="" class="copyright"><?php the_field('copyright', 'options') ?>
            <br>Україна, <?php echo $arr_3[1]; ?>
            <br><span itemprop="telephone"><a style="text-decoration: none;" href="tel:<?php echo $arr_1[0]; ?>"><?php echo $arr_1[0]; ?></a></span>, <span itemprop="telephone"><a style="text-decoration: none;" href="tel:<?php echo $arr_1[0]; ?>"><?php echo $arr_2[0]; ?></a></span>
        </p>

        <div class="develop">
            <p>
                <a rel="nofollow" href="//page.ua/" target="_blank" class="nosub">Створення сайту</a> — <a rel="nofollow" href="//page.ua/" target="_blank">Page Group</a>
            </p>
        </div>
        <div class="socials">
            <a href="//www.facebook.com/friedmanukraine/" class="socials__link socials__link_fb" target="_blank"></a>
            <a href="//t.me/friedmancustoms" class="socials__link socials__link_tg" target="_blank"></a>
            <a href="//www.instagram.com/friedmanukraine/?igshid=agxwczlsw46" class="socials__link socials__link_ins" target="_blank"></a>
        </div>


    </div>
</footer>

</body>
<?php
wp_footer();
/**
 * For icons
 */
$page_id = $post->ID;
if ($page_id==11260) {
?>
<style type="text/css">
/** For icons **/
.content-column .documents-two-column .column ul li {
    background:url('//xn--80ahyflx1k.xn--j1amh/wp-content/uploads/2017/09/mini2.png') no-repeat !important;
}
</style>

<script type="text/javascript">
    $(".header>a.logo").attr("href","/ua/golovna/")
</script>

<?php } ?>
</html>