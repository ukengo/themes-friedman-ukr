<?
/*
Template Name: Контакты
*/
get_header();
$user_id = get_current_user_id();
$address = get_field('address', 'options');
$arr_3 = explode('<br />', $address);
?>
    <div class="content-position">
        <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/scripts1.js"></script>

        <div class="content-column">

            <?php
            if (function_exists('yoast_breadcrumb')) {
                yoast_breadcrumb('<div class="breadcrumbs" id="breadcrumbs">', '</div>');
            }
            ?>
            <h1><?php the_title(); ?></h1>

            <div class="news-page" itemscope itemtype="//schema.org/Organization">
                <div class="hr"></div>
                <span style="display:none" itemprop="name"> <?php pll_e('ООО «Фридман-Украина»'); ?> </span>
                <p class="contact_header"><?php pll_e('Как к нам добраться:'); ?></p>
                <p class="note margin-cancel">
                    <?php the_field('address', 'options'); ?>
                </p>
                <?php
                $location = get_field('contacts_map', 'options');
                if (!empty($location)):
                    ?>
                    <div class="map">
                        <div class="marker" data-lat="<?php echo $location['lat']; ?>"
                             data-lng="<?php echo $location['lng']; ?>">
                        </div>
                    </div>

                <?php endif; ?>
                            <?php
                $phones_1 = get_field('phones','options');
                $phones_2 = get_field('phones_2','options');

                $arr_1 = explode(',', $phones_1);
                $arr_2 = explode(',', $phones_2);
                ?>
            
                <p class="contact_header"><?php pll_e(' Контакты '); ?></p>
                <p class="note margin-cancel" itemprop="telephone">
                    <a style="text-decoration: none;" href="tel:<?php echo $arr_2[0]; ?>"><?php echo $arr_2[0]; ?></a>, 
                    <a style="text-decoration: none;" href="tel:<?php echo $arr_2[1]; ?>"><?php echo $arr_2[1]; ?></a>
                    
                </p>
                <p class="note margin-cancel">
                    <a style="text-decoration: none;" href="tel:<?php echo $arr_1[0]; ?>"><?php echo $arr_1[0]; ?></a>, 
                    <a style="text-decoration: none;" href="tel:<?php echo $arr_1[1]; ?>"><?php echo $arr_1[1]; ?></a>
                </p>

                <p class="note margin-cancel">
                    E-mail: <a
                            href="mailto:<?php the_field("mail", "options"); ?>"><?php the_field("mail", "options"); ?>
                        <br></a>
                </p>

                <p class="note margin-cancel">
                    Skype: <span class="enable"><?php the_field('skype', 'options'); ?></span>
                </p>
                <a name="form_s"></a>
                <p class="contact_header"><?php pll_e('Обратная связь:'); ?></p>

                <?php echo do_shortcode('[contact-form-7 id="1956" title="Contact form 1"]'); ?>

            </div>
        </div>
        <?php get_sidebar(); ?>
    </div>
    <div id="seo-text">
    </div>
<?php get_sidebar('news'); ?>

    <div class="footer-place"></div>

    </section>
<!--
<?php
$location = get_field('contacts_map', 'options');

$lat = $location['lat'];
$lng = $location['lng'];
?>
-->
<div style="display: none;">
    <?php
    echo '<pre>';
    var_dump($location);
    ?>
</div>

    <script type="text/javascript">
        $(function () {
            function initMap($el) {
                var $markers = $el.find('.marker');
                var args = {
                    zoom: 16,
                    center: new google.maps.LatLng(<?php echo $location['lat']; ?>, <?php echo $location['lng']; ?>),
                    mapTypeId: google.maps.MapTypeId.ROADMAP,
                    styles: []
                };
                var map = new google.maps.Map($el[0], args);
                map.markers = [];
                $markers.each(function () {
                    add_marker($(this), map);
                });
                center_map(map);
                return map;

            }

            function add_marker($marker, map) {
                var latlng = new google.maps.LatLng($marker.attr('data-lat'), $marker.attr('data-lng'));

                var markerImage = new google.maps.MarkerImage(
                    '<?php echo get_template_directory_uri(); ?>/img/placeholder_blue.png'
                );

                var marker = new google.maps.Marker({
                    position: latlng,
                    map: map,
                    icon: markerImage,
                    styles: [{weight: '0.01'}]
                });

                map.markers.push(marker);

                var contentf = '<?php pll_e('Украина'); ?>, <?php echo $arr_3[1]; ?>';

                if ($marker.html()) {
                    var infowindow = new google.maps.InfoWindow({
                        content: contentf
                    });

                    infowindow.open(map, marker);

                    google.maps.event.addListener(marker, 'click', function () {

                        infowindow.open(map, marker);

                    });
                }

            }

            function center_map(map) {

                var bounds = new google.maps.LatLngBounds();

                $.each(map.markers, function (i, marker) {

                    var latlng = new google.maps.LatLng(marker.position.lat(), marker.position.lng());

                    bounds.extend(latlng);

                });

                if (map.markers.length == 1) {
                    map.setCenter(bounds.getCenter());
                    map.setZoom(17);
                }
                else {
                    map.fitBounds(bounds);
                }

            }
            var map = null;
            $('.map').each(function () {
                // create map
                map = initMap($(this));
            });
        });
    </script>

    <script defer src="//maps.googleapis.com/maps/api/js?key=AIzaSyCGaWaxYCfH2xvloNX54UB1EbGdtTx7VNI"
            type="text/javascript"></script>
<?php get_footer();
