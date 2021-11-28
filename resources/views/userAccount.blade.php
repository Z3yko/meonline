<x-app-layout>

<div class="w-full border-b-3 border-t-1 border-mygreenDark border-opacity-40 px-3 py-3">
    <h2 class="text-mygreenSDark font-bold">Here you can change your account information</h2>
</div>

<div id="app">
    <account
    account-user={{$name}}
    account-email={{$email}}
    email-verified={{$emailVerified}}
    ></account>
</div>

</x-app-layout>
 

 