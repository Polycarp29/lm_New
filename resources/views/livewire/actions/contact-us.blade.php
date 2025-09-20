<form id="contact" wire:submit.prevent="save">
    @csrf <!-- Include CSRF protection -->
    @if (session()->has('message'))
        <div class="bg-green-500 text-white p-2 rounded m-2">
            {{ session('message') }}
        </div>
    @endif
    <!-- Error Message -->
    @if (session()->has('error'))
        <div class="bg-red-500 text-white p-2 rounded m-2">
            {{ session('error') }}
        </div>
    @endif

    @if ($errors->has('form'))
        <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
            {{ $errors->first('form') }}
        </div>
    @endif
    <div class="row">
         <!-- Honeypot Field -->
         <div style="display: none;">
            <input type="text" wire:model="honeypot" autocomplete="off">
        </div>
        <div class="col-lg-6">
            <fieldset>
                <input type="text" name="name" id="name" placeholder="Name" autocomplete="on"
                    wire:model="name">
                @error('name')
                    <span class="error p-6 text-red-600">{{ $message }}</span>
                @enderror
            </fieldset>
        </div>
        <div class="col-lg-6">
            <fieldset>
                <input type="text" name="surname" id="surname" placeholder="Surname" autocomplete="on"
                    wire:model="surname">
                @error('surname')
                    <span class="error p-6 text-red-600">{{ $message }}</span>
                @enderror
            </fieldset>
        </div>
        <div class="col-lg-12">
            <fieldset>
                <input type="email" name="email" id="email" placeholder="Your Email" wire:model="email">
                @error('email')
                    <span class="error p-6 text-red-600">{{ $message }}</span>
                @enderror
            </fieldset>
        </div>
        <div class="col-lg-12">
            <fieldset>
                <textarea name="message" class="form-control" id="message" wire:model="message" placeholder="Message"></textarea>
                @error('message')
                    <span class="error p-6 text-red-600">{{ $message }}</span>
                @enderror
            </fieldset>
        </div>
        <div class="col-lg-12">
            <fieldset>
                <button type="submit" id="form-submit" class="main-button">Send Message</button>
            </fieldset>
        </div>
    </div>
    <div class="contact-dec">
        <img src="{{ asset('assets/images/contact-decoration.png') }}" alt="">
    </div>
</form>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
