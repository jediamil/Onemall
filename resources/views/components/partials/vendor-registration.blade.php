<div class="flex">
    <form action="" method="POST" class="space-y-4">
        @csrf
        <input type="text" name="first_name" placeholder="First Name" required class="border p-2 w-full">
        <input type="text" name="last_name" placeholder="Last Name" required class="border p-2 w-full">
        <input type="email" name="email" placeholder="Email" required class="border p-2 w-full">
        <input type="password" name="password" placeholder="Password" required class="border p-2 w-full">
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Register</button>
    </form>
</div>