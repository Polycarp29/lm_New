<x-layouts.app>
    @section('title', 'Learn more About Lee Marketing and what we offer')
    @section('meta_title', 'Learn more About Lee Marketing and what we offer')
    @section('meta_description', $seoDetails->about_us_description)
    @section('meta_image', asset('storage/' . $seoDetails->logo))
    {{-- About Us --}}
    @livewire('Pages.Section.upperAboutSection');

    {{-- Our Story --}}
    @livewire('Pages.Section.our-story')
    {{-- Our Story End --}}

    {{-- Clients --}}
    <section class="p-12 mt-12">
        <div class="container mx-auto wow fadeInLeft">
                @livewire('pages.section-middle-about-section-resource')
        </div>
    </section>



    {{-- Customer FeedBack --}}

    <div class="responsive-container-block big-container">
        <div class="responsive-container-block bg">
            <p class="text-blk title">
                {{ $testimonials }}
            </p>
            <p class="text-blk desc">
               {{ $description}}
            </p>
            @livewire('Pages.Section.testimonals')
        </div>
    </div>

    <style>
        .responsive-cell-block {
            min-height: 75px;
        }

        .text-blk {
            margin-top: 0px;
            margin-right: 0px;
            margin-bottom: 0px;
            margin-left: 0px;
            padding-top: 0px;
            padding-right: 0px;
            padding-bottom: 0px;
            padding-left: 0px;
            line-height: 25px;
            height: 50%;
            width: 100%;
        }

        img {
            object-fit: cover;
        }

        .responsive-container-block {
            min-height: 75px;
            height: fit-content;
            width: 100%;
            padding-top: 0px;
            padding-right: 0px;
            padding-bottom: 0px;
            padding-left: 0px;
            display: flex;
            flex-wrap: wrap;
            margin-top: 0px;
            margin-right: auto;
            margin-bottom: 0px;
            margin-left: auto;
            justify-content: flex-start;
        }

        .responsive-container-block.bg {
            width: 100%;
            height: auto;
            flex-direction: column;
            justify-content: flex-start;
            align-items: center;
            max-width: 1320px;
            margin: 50px 0 50px 0;
        }

        .text-blk.title {
            width: 100%;
            height: auto;
            text-align: center;
            font-size: 36px;
            line-height: 45px;
            font-weight: 900;
            margin-top: 0px;
            margin-right: 0px;
            margin-bottom: 0px;
            margin-left: 0px;
            margin: 0 0 15px 0;
        }

        * {
            font-family: Nunito, sans-serif;
        }

        .text-blk.desc {
            text-align: center;
            font-size: 18px;
            line-height: 28px;
            height: auto;
            margin-top: 0px;
            margin-right: 0px;
            margin-bottom: 50px;
            margin-left: 0px;
            max-width: 750px;
        }

        .responsive-container-block.blocks {
            width: 100%;
            min-height: 0px;
            justify-content: space-between;
            max-width: 1320px;
        }

        .responsive-cell-block.wk-desk-1.wk-tab-1.wk-mobile-1.wk-ipadp-1.content {
            width: 30%;
            height: auto;
            box-shadow: rgba(0, 0, 0, 0.05) 0px 4px 20px 7px;
            border-top-left-radius: 16px;
            border-top-right-radius: 16px;
            border-bottom-right-radius: 16px;
            border-bottom-left-radius: 16px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .text-blk.info-block {
            width: 85%;
            height: auto;
            font-size: 18px;
            line-height: 30px;
            margin-top: 30px;
            margin-right: 0px;
            margin-bottom: 50px;
            margin-left: 0px;
            margin: 30px 0 30px 0;
        }

        .responsive-container-block.person {
            width: 90%;
            min-height: 0px;
            height: auto;
            margin-top: 0px;
            margin-right: 31.25px;
            margin-bottom: 20px;
            margin-left: 31.25px;
        }

        .responsive-cell-block.wk-desk-6.wk-ipadp-6.wk-tab-12.wk-mobile-12.icon-block {
            width: 22%;
            height: auto;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .responsive-cell-block.wk-desk-6.wk-ipadp-6.wk-tab-12.wk-mobile-12.text-block {
            width: 78%;
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            justify-content: center;
        }

        .text-blk.name {
            font-size: 18px;
            line-height: 20px;
            font-weight: 900;
            height: auto;
            width: 100%;
            padding-top: 10px;
            padding-right: 10px;
            padding-bottom: 0px;
            padding-left: 10px;
        }

        .text-blk.desig {
            line-height: 16px;
            height: auto;
            width: 100%;
            padding-top: 10px;
            padding-right: 10px;
            padding-bottom: 10px;
            padding-left: 10px;
        }

        .profile-img {
            width: 60px;
            height: 60px;
            border-top-left-radius: 50%;
            border-top-right-radius: 50%;
            border-bottom-right-radius: 50%;
            border-bottom-left-radius: 50%;
        }

        .responsive-container-block.big-container {
            justify-content: center;
            padding: 0 50px 0 50px;
        }

        @media (max-width: 1024px) {
            .responsive-cell-block.wk-desk-1.wk-tab-1.wk-mobile-1.wk-ipadp-1.content {
                width: 47%;
            }

            .responsive-cell-block.wk-desk-1.wk-tab-1.wk-mobile-1.wk-ipadp-1.content.bottom {
                margin-top: 5%;
                margin-right: 0px;
                margin-bottom: 0px;
                margin-left: 25%;
            }

            .text-blk.desc {
                width: 70%;
            }

            .responsive-container-block.person {
                margin-top: 5%;
                margin-right: 31.25px;
                margin-bottom: 0px;
                margin-left: 31.25px;
            }

            .text-blk.title {
                margin-top: 0px;
                margin-right: 0px;
                margin-bottom: 0px;
                margin-left: 0px;
            }

            .responsive-container-block.person {
                margin-top: 21.9375px;
                margin-right: 31.25px;
                margin-bottom: 20px;
                margin-left: 31.25px;
            }

            .text-blk.info-block {
                margin-top: 30px;
                margin-right: 0px;
                margin-bottom: 25px;
                margin-left: 0px;
            }
        }

        @media (max-width: 768px) {
            .responsive-container-block.person {
                margin-top: 0px;
                margin-right: 31.25px;
                margin-bottom: 0px;
                margin-left: 31.25px;
            }

            .text-blk.info-block {
                height: 50%;
                font-size: 17px;
            }

            .responsive-cell-block.wk-desk-1.wk-tab-1.wk-mobile-1.wk-ipadp-1.content {
                width: 100%;
                margin-top: 0px;
                margin-right: 0px;
                margin-bottom: 5%;
                margin-left: 0px;
            }

            .text-blk.desc {
                margin-top: 0px;
                margin-right: 0px;
                margin-bottom: 80px;
                margin-left: 0px;
                width: 85%;
                font-size: 17px;
            }

            .text-blk.title {
                margin-top: 0px;
                margin-right: 0px;
                margin-bottom: 0px;
                margin-left: 0px;
                font-size: 30px;
            }

            .responsive-cell-block.wk-desk-1.wk-tab-1.wk-mobile-1.wk-ipadp-1.content.bottom {
                width: 100%;
                margin-top: 0px;
                margin-right: 0px;
                margin-bottom: 0px;
                margin-left: 0px;
            }

            .responsive-container-block.blocks {
                margin-top: 0px;
                margin-right: 0px;
                margin-bottom: 0px;
                margin-left: 0px;
            }

            .responsive-container-block.bg {
                flex-wrap: nowrap;
            }

            .responsive-container-block.person {
                margin-top: 0px;
                margin-right: 31.25px;
                margin-bottom: 20px;
                margin-left: 31.25px;
            }

            .text-blk.info-block {
                margin-top: 30px;
                margin-right: 0px;
                margin-bottom: 30px;
                margin-left: 0px;
            }

            .text-blk.desc {
                margin-top: 0px;
                margin-right: 0px;
                margin-bottom: 30px;
                margin-left: 0px;
            }

            .text-blk.desig {
                font-size: 15px;
            }

            .text-blk.name {
                font-size: 17px;
            }
        }

        @media (max-width: 500px) {
            .responsive-cell-block.wk-desk-1.wk-tab-1.wk-mobile-1.wk-ipadp-1.content {
                width: 100%;
                margin-top: 0px;
                margin-right: 0px;
                margin-bottom: 8%;
                margin-left: 0px;
            }

            .text-blk.desc {
                width: 90%;
                margin-top: 0px;
                margin-right: 0px;
                margin-bottom: 0px;
                margin-left: 0px;
                font-size: 16px;
                line-height: 24px;
            }

            .text-blk.title {
                margin-top: 0px;
                margin-right: 0px;
                margin-bottom: 0px;
                margin-left: 0px;
                font-size: 26px;
            }

            .text-blk.info-block {
                margin-top: 30px;
                margin-right: 0px;
                margin-bottom: 50px;
                margin-left: 0px;
                font-size: 16px;
                line-height: 26px;
                margin: 30px 0 20px 0;
            }

            .text-blk.desc {
                margin-top: 0px;
                margin-right: 0px;
                margin-bottom: 30px;
                margin-left: 0px;
            }

            .responsive-container-block.big-container {
                padding: 0 30px 0 30px;
            }

            .text-blk.name {
                font-size: 17px;
            }

            .text-blk.desig {
                font-size: 15px;
            }
        }
    </style>


</x-layouts.app>
