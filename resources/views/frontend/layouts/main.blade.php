<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <base href="{{asset('')}}">

    {{--    <meta name="csrf-token" content="{{ csrf_token() }}">--}}

    <meta name="keywords" content="Mỹ Phẩm" />
    <meta name="description"
          content="Mỹ Phẩm " />
    <meta name="description"
          content="Mỹ Phẩm " />
    <meta property="og:locale" content="vi_VN" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="Mỹ Phẩm" />
    <meta property="og:description"
          content="Mỹ Phẩm " />
    <meta property="og:url" content="" />
    <meta property="og:site_name" content="Wine Viet Y" />
    <meta property="og:image" content="/frontend/images/logo.png" />
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:description"
          content="Mỹ Phẩm " />
    <meta name="twitter:title" content="Mỹ Phẩm " />
    <meta property="article:tag" content="Mỹ Phẩm" />
    <meta property="article:section" content="Tin tức" />
    <meta property="article:published_time" content="8/20/2020 12:00:00 AM" />
    <meta property="article:modified_time" content="8/20/2020 12:00:00 AM" />


    <meta name="robots" content="max-snippet:-1, max-image-preview:large, max-video-preview:-1" />
    <title>Mỹ Phẩm </title>
    <link rel="canonical" href="" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css">
    <link href="/frontend/bootstrap4/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="/frontend/slick/slick.css">
    <link rel="stylesheet" type="text/css" href="/frontend/slick/slick-theme.css">
    <link rel="stylesheet" href="/frontend/css/layout.css">
    <link rel="stylesheet" href="/frontend/css/index.css">
    <link rel="stylesheet" href="/frontend/css/product.css">
    <link rel="stylesheet" href="/frontend/css/dropMenu.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-100615822-3"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag() { dataLayer.push(arguments); }
        gtag('js', new Date());

        gtag('config', 'UA-100615822-3');
    </script>

    <script type='application/ld+json'>
		{
		  "context": "http://www.schema.org",
		  "type": "WebSite",
		  "name": "mypham",
		  "alternateName": "ShopMypham",
		  "url": "https://mypham.vn"
		}
	 </script>
</head>

<body>
<section class="main">
    @include('frontend.layouts.header')
    @yield('content')

    @include('frontend.layouts.footer')





</section>
<script src="/frontend/bootstrap4/js/bootstrap.min.js"></script>
<script src="/frontend/slick/slick.js" type="text/javascript" charset="utf-8"></script>
<script src="/frontend/js/layout.js"></script>
<script>
    function setMenuActive() {
        $('.menu ul li').each(function () {
            $('.menu ul li').removeClass("active");
        });
        let url = window.location.href;
        slug = url.substring(url.lastIndexOf('/'));
        $('.menu ul li').each(function () {
            let link = $(this).children('a').attr('href');
            if (slug.toLowerCase() == link.toLowerCase()) {
                $(this).addClass('active');
            }
        });
    }
    setMenuActive();
</script>

<script src="/frontend/Script/sweetalert.min.js"></script>
<script src="/frontend/Script/toastr.js"></script>
<script>
    $(".banner").slick({
        dots: true,
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1
    });
    $(".regular").slick({
        dots: false,
        infinite: true,
        slidesToShow: 4,
        slidesToScroll: 1,
        responsive: [
            {
                breakpoint: 1199,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 991,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 575,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
            // You can unslick at a given breakpoint now by adding:
            // settings: "unslick"
            // instead of a settings object
        ]
    });
    $(".partner-slide").slick({
        dots: false,
        infinite: true,
        slidesToShow: 6,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000,
        responsive: [
            {
                breakpoint: 1199,
                settings: {
                    slidesToShow: 5,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 991,
                settings: {
                    slidesToShow: 4,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 767,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 575,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1
                }
            }
            // You can unslick at a given breakpoint now by adding:
            // settings: "unslick"
            // instead of a settings object
        ]
    });

    $(document).ready(function () {
        var contentnews = $('.news .sub-news-content').text();
        console.log(contentnews.trim());
        var noidungmoi = contentnews.trim().substr(0, 100) + '...';
        console.log(noidungmoi);
        $('.news .sub-news-content').html('');
        $('.news .sub-news-content').text(noidungmoi);

    });
</script>

<script>
    submitMail();
    function submitMail() {
        $('.savePhone').click(function () {
            var data = $(this).siblings('input').val();
            if (data != '') {
                $.ajax({
                    url: '/Home/savePhoneOrMail',
                    type: 'POST',
                    dataType: 'json',
                    contentType: 'application/json',
                    data: JSON.stringify({
                        data: data
                    }),

                    beforeSend: function () {

                    },
                    success: function (res) {
                        if (res != null) {
                            swal({
                                title: "Thông báo",
                                text: "Cảm ơn bạn đã ghé shop!\n Shop sẽ liên lạc cho bạn với thời gian sớm nhất",
                                icon: "success",
                                dangerMode: true,
                            }).then(() => {

                            });
                        } else {
                            swal({
                                title: "Thông báo",
                                text: "Thông tin không đúng :(",
                                icon: "warning",
                                dangerMode: true,
                            });
                        }
                    },
                    error: function () {
                    },
                    complete: function () {
                    }
                })
            }
            else {
                swal({
                    title: "Thông báo",
                    text: "Bạn chưa điền thông tin  :(",
                    icon: "warning",
                    dangerMode: true,
                });
            }

        })
    }
</script>
<script>
    var company_info = new Object();
    var phone = [];
    var address = [];
    var email = [];
    $.ajax({
        url: '/home/InforCompany',
        type: 'GET',
        dataType: 'json',
        contentType: 'application/json',
        data: {},
        beforeSend: function () {
        },
        success: function (res) {
            company_info = res;
            $('.com-name').text(company_info.NAME)
            let str_phones = company_info.PHONE;
            let phones = str_phones.split(";");

            let strPhone = `<i class="fas fa-phone-alt"></i>`;
            $.each(phones, function (index, value) {
                let val = convertPhone(value);
                phone.push(convertPhone(value));
                strPhone += ` <a href="tel:${val}" title="${value}">${value}</a> | `;
            });
            strPhone = strPhone.substr(0, strPhone.length - 2);
            $('.com-phone').html(strPhone);

            let email = company_info.EMAIL;
            let emails = email.split(";");

            let strEmail = `<i class="fas fa-envelope"></i>`;
            $.each(emails, function (index, value) {
                strEmail += `<a href="mailto:${value}" title="${value}">${value}</a> | `;
            });
            strEmail = strEmail.substr(0, strEmail.length - 2);
            $('.com-email').html(strEmail);

            let str_address = company_info.ADDRESS.split(";");
            let strAdd = `<i class="fas fa-map-marker-alt"></i>`;
            $.each(str_address, function (index, value) {
                strAdd += `${value} <br/>`;
            })
            strAdd = strAdd.substr(0, strAdd.length - 5);
            $('.com-address').html(strAdd);

            let socials = ` <a href="${company_info.FACEBOOK}" target="_blank">
<i class="fab fa-facebook-square"></i>
</a>
<a href="${company_info.YOUTUBE}" target="_blank"><i class="fab fa-youtube-square"></i></i></a>
<a href="mailto:${company_info.EMAIL}" target="_blank">
<i class="far fa-envelope"></i>
</a>`;
            $('.social-icon').html(socials);

            $('.main .logo img').attr('src', company_info.LOGO);
        },
        error: function () {

        },
        complete: function () {

        }
    });
    function convertPhone(input) {
        let out = input;
        out = input.trim();
        out = out.replace(/\./g, "");
        out = out.replace(/\,/g, "");
        out = out.replace(/[ ]/g, "");
        return out;
    }
</script>


</body>

</html>
