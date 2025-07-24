<section class="wrapper flex flex-col gap-2.5 items-center justify-center">
    <p class="text-4xl font-extrabold text-center">
        We Provide <br>
        Best Medicines
    </p>
    <form action="{{ route('front.product.search') }}" method="GET" id="searchForm" class="w-full">
        <input style="background-image: url({{ asset('assets/svgs/ic-search.svg') }})" type="text" name="keyword"
            id="searchProduct"
            class="block w-full py-3.5 pl-4 pr-10 rounded-[50px] font-semibold placeholder:text-grey placeholder:font-normal text-black text-base bg-no-repeat bg-[calc(100%-16px)] focus:ring-2 focus:ring-primary focus:outline-none focus:border-none transition-all"
            placeholder="Search by product name">
    </form>
</section>
