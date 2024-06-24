<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/output.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap"
        rel="stylesheet" />
    <!-- CSS -->
    <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">
</head>

<body class="text-black font-poppins pt-10">
    <div id="checkout-section"
        class="max-w-[1200px] mx-auto w-full min-h-[calc(100vh-40px)] flex flex-col gap-[30px] bg-[url('assets/background/Hero-Banner.png')] bg-center bg-no-repeat bg-cover rounded-t-[32px] overflow-hidden relative pb-6">
        <nav class="flex justify-between items-center pt-6 px-[50px]">
            <a href="index.html">
                <img src="assets/logo/logo.svg" alt="logo">
            </a>
            <ul class="flex items-center gap-[30px] text-white">
                <li>
                    <a href="{{ route('front.index') }}" class="font-semibold">Home</a>
                </li>
                <li>
                    <a href="{{ route('front.pricing') }}" class="font-semibold">Pricing</a>
                </li>
                <li>
                    <a href="" class="font-semibold">Benefits</a>
                </li>
                <li>
                    <a href="" class="font-semibold">Stories</a>
                </li>
            </ul>
            <div class="flex gap-[10px] items-center">
                <div class="flex flex-col items-end justify-center">
                    <p class="font-semibold text-white">{{ Auth::user()->name }}</p>
                    @if (Auth::user()->hasActiveSubscription())
                        <p class="p-[2px_10px] rounded-full bg-[#FF6129] font-semibold text-xs text-white text-center">
                            PRO
                        </p>
                    @else
                    @endif
                    <!-- <p class="p-[2px_10px] rounded-full bg-[#FF6129] font-semibold text-xs text-white text-center">PRO</p> -->
                </div>
                <div class="w-[56px] h-[56px] overflow-hidden rounded-full flex shrink-0">
                    <a href="{{ route('dashboard') }}">
                        <img src="{{ Storage::url(Auth::user()->avatar) }}" class="w-full h-full object-cover"
                            alt="photo">
                    </a>
                </div>
            </div>
        </nav>
        <div class="flex flex-col gap-[10px] items-center">
            <div
                class="gradient-badge w-fit p-[8px_16px] rounded-full border border-[#FED6AD] flex items-center gap-[6px]">
                <div>
                    <img src="assets/icon/medal-star.svg" alt="icon">
                </div>
                <p class="font-medium text-sm text-[#FF6129]">Invest In Yourself Today</p>
            </div>
            <h2 class="font-bold text-[40px] leading-[60px] text-white">Checkout Subscription</h2>
        </div>
        <div class="flex gap-10 px-[100px] relative z-10">
            <div class="w-[400px] flex shrink-0 flex-col bg-white rounded-2xl p-5 gap-4 h-fit">
                <p class="font-bold text-lg">Package</p>
                <div class="flex items-center justify-between w-full">
                    <div class="flex items-center gap-3">
                        <div class="w-[50px] h-[50px] flex shrink-0 rounded-full overflow-hidden">
                            <img src="assets/icon/Web Development 1.svg" class="w-full h-full object-cover"
                                alt="photo">
                        </div>
                        <div class="flex flex-col gap-[2px]">
                            <p class="font-semibold">Premium</p>
                            <p class="text-sm text-[#6D7786]">30 days access</p>
                        </div>
                    </div>
                    <p class="p-[4px_12px] rounded-full bg-[#FF6129] font-semibold text-xs text-white text-center">
                        Popular</p>
                </div>
                <hr>
                <div class="flex flex-col gap-5">
                    <div class="flex gap-3">
                        <div class="w-6 h-6 flex shrink-0">
                            <img src="assets/icon/tick-circle.svg" class="w-full h-full object-cover" alt="icon">
                        </div>
                        <p class="text-[#475466]">Access all course materials</p>
                    </div>
                    <div class="flex gap-3">
                        <div class="w-6 h-6 flex shrink-0">
                            <img src="assets/icon/tick-circle.svg" class="w-full h-full object-cover" alt="icon">
                        </div>
                        <p class="text-[#475466]">Unlock all course badges for jobs</p>
                    </div>
                    <div class="flex gap-3">
                        <div class="w-6 h-6 flex shrink-0">
                            <img src="assets/icon/tick-circle.svg" class="w-full h-full object-cover" alt="icon">
                        </div>
                        <p class="text-[#475466]">Receive premium rewards</p>
                    </div>
                </div>
                <p class="font-semibold text-[28px] leading-[42px]">Rp 429000</p>
            </div>
            <form action="{{ route('front.checkout.store') }}" method="POST" enctype="multipart/form-data"
                class="w-full flex flex-col bg-white rounded-2xl p-5 gap-5">
                @csrf
                <p class="font-bold text-lg">Send Payment</p>
                <div class="flex flex-col gap-5">
                    <div class="flex items-center justify-between">
                        <div class="flex gap-3">
                            <div class="w-6 h-6 flex shrink-0">
                                <img src="assets/icon/tick-circle.svg" class="w-full h-full object-cover"
                                    alt="icon">
                            </div>
                            <p class="text-[#475466]">Bank Name</p>
                        </div>
                        <p class="font-semibold">Angga Capital</p>
                        <input type="hidden" name="bankName" value="Angga Capital">
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex gap-3">
                            <div class="w-6 h-6 flex shrink-0">
                                <img src="assets/icon/tick-circle.svg" class="w-full h-full object-cover"
                                    alt="icon">
                            </div>
                            <p class="text-[#475466]">Account Number</p>
                        </div>
                        <p class="font-semibold">22081996202191404</p>
                        <input type="hidden" name="accountNumber" value="22081996202191404">
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex gap-3">
                            <div class="w-6 h-6 flex shrink-0">
                                <img src="assets/icon/tick-circle.svg" class="w-full h-full object-cover"
                                    alt="icon">
                            </div>
                            <p class="text-[#475466]">Account Name</p>
                        </div>
                        <p class="font-semibold">Alqowy Education First</p>
                        <input type="hidden" name="accountName" value="Alqowy Education First">
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex gap-3">
                            <div class="w-6 h-6 flex shrink-0">
                                <img src="assets/icon/tick-circle.svg" class="w-full h-full object-cover"
                                    alt="icon">
                            </div>
                            <p class="text-[#475466]">Code Swift</p>
                        </div>
                        <p class="font-semibold">ACEFIRSTBANK</p>
                        <input type="hidden" name="swift" value="ACEFIRSTBANK">
                    </div>
                </div>
                <hr>
                <p class="font-bold text-lg">Confirm Your Payment</p>
                <div class="relative">
                    <button type="button"
                        class="p-4 rounded-full flex gap-3 w-full ring-1 ring-black transition-all duration-300 hover:ring-2 hover:ring-[#FF6129]"
                        onclick="document.getElementById('file').click()">
                        <div class="w-6 h-6 flex shrink-0">
                            <img src="assets/icon/note-add.svg" alt="icon">
                        </div>
                        <p id="fileLabel">Add a file attachment</p>
                    </button>
                    <input id="file" type="file" name="proof" class="hidden"
                        onchange="updateFileName(this)">
                </div>
                <button type="submit"
                    class="p-[20px_32px] bg-[#FF6129] text-white rounded-full text-center font-semibold transition-all duration-300 hover:shadow-[0_10px_20px_0_#FF612980]">I've
                    Made The Payment
                </button>
            </form>
        </div>
        <div class="flex justify-center absolute transform -translate-x-1/2 left-1/2 bottom-0 w-full">
            <img src="assets/background/alqowy.svg" alt="background">
        </div>
    </div>

    <!-- JavaScript -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="main.js"></script>

</body>

</html>
