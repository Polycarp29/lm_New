<section>
    <section>
        {{-- Partners Heading --}}
        <div class="py-4 flex  justify-center">
            <h1 class="text-3xl font-bold text-gray-600">We Work With Global Brands</H1>
        </div>
        <div class="flex justify-center py-6">
            <p class="text-xl text-gray-600 font-light block text-center">
                We have worked with reputable organizations to deliver high standard marketing and web solutions.
            </p>
        </div>
    </section>

    <section class="slide-option mt-0 flex justify-center">
        <div id="infinite" class="highway-slider">
            <div class="xl:container max-auto highway-barrier">
                <ul class="highway-lane">
                    @foreach ($getPartners as $partner)
                        <li class="highway-car"><img src="{{ asset('storage/' . $partner->partner_logo) }}" alt="Angular"></li>
                    @endforeach
                </ul>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const lane = document.querySelector(".highway-lane");
            const items = [...lane.children];
            const totalItemsWidth = items.length * 180; // Adjust based on li width
            const barrier = document.querySelector(".highway-barrier");

            // Clone items for seamless scrolling
            items.forEach(item => {
                const clone = item.cloneNode(true);
                lane.appendChild(clone);
            });

            // Dynamic animation to maintain infinite effect
            let animation;
            const startAnimation = () => {
                const startTime = performance.now();
                const loop = (currentTime) => {
                    const elapsed = currentTime - startTime;
                    const distance = (elapsed / 20) % totalItemsWidth; // Adjust speed
                    lane.style.transform = `translateX(-${distance}px)`;
                    animation = requestAnimationFrame(loop);
                };
                animation = requestAnimationFrame(loop);
            };

            const stopAnimation = () => cancelAnimationFrame(animation);

            // Start animation
            startAnimation();

            // Pause on hover
            barrier.addEventListener("mouseenter", stopAnimation);
            barrier.addEventListener("mouseleave", startAnimation);
        });
    </script>
    <style>
        div.container {
            transition: all 0.3s ease;
        }

        h3 {
            margin: 0 0 25px 0;
        }

        section.slide-option {
            margin: 0 0 50px 0;
        }

        div.highway-slider {
            display: flex;
            justify-content: center;
            width: 100%;
            height: 150px;
        }

        div.highway-barrier {
            overflow: hidden;
            position: relative;
        }

        ul.highway-lane {
            display: flex;
            gap: 20px;
            animation: scrollLoop 40s linear infinite;
            /* Slower animation */
            will-change: transform;
            transition: animation-play-state 0.3s ease;
        }

        li.highway-car {
            flex: 0 0 180px;
            /* Fixed width of each item */
            display: flex;
            justify-content: center;
            align-items: center;
            background: #fff;
            color: #343434;
        }

        span.fab {
            font-size: 65px;
        }

        @keyframes translateinfinite {
            0% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(calc(-180px * 12));
                /* Adjust based on the total items */
            }
        }

        div.highway-barrier::before,
        div.highway-barrier::after {
            content: "";
            position: absolute;
            width: 180px;
            height: 100%;
            z-index: 1;
        }

        div.highway-barrier::before {
            top: 0;
            left: 0;
            background: linear-gradient(to right, rgba(255, 255, 255, 1) 0%, rgba(255, 255, 255, 0) 100%);
        }

        div.highway-barrier::after {
            top: 0;
            right: 0;
            background: linear-gradient(to left, rgba(255, 255, 255, 1) 0%, rgba(255, 255, 255, 0) 100%);
        }

        li.highway-car {
            flex: 0 0 180px;
            /* Width of each item */
            display: flex;
            justify-content: center;
            align-items: center;
            background: #fff;
            color: #343434;
        }

        li.highway-car img {
            width: 200px;
            /* Fixed image width */
            height: 200px;
            /* Fixed image height */
            object-fit: contain;
            /* Ensure images fit without distortion */
            display: block;
        }
    </style>
</section>
