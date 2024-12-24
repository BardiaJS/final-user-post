<x-logged-in-page-layout>
    <div class="container py-md-5 container--narrow">
        <div class="text-center">
            <h2>Hello dear <strong>{{auth()->user()->display_name}}</strong>, welcome to your page</h2>
            <img src="welcome.png">
        </div>
    </div>

</x-logged-in-page-layout>
