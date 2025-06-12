<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Scholarship</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="relative">
    <!-- Button -->
    <div class="p-4">
        <button id="toggleSidebar" class="px-4 py-2 mb-2 bg-blue-600 text-white rounded cursor-pointer">
            Apply
        </button>

    </div>

    <!-- Sidebar -->
    <div id="sidebar"
        class="fixed top-0 right-0 h-full w-full max-w-2xl bg-[#f6f6f6] text-black transform translate-x-full transition-transform duration-300 ease-in-out z-50 shadow-lg">
        <div class="flex flex-row md:grid md:grid-cols-5 h-full">
            <div class="col-span-2 bg-gray-400 flex justify-center items-center p-6 overflow-hidden w-64 mx-auto">
                <img src="//frontend.ciat.edu/assets/images/mischeaderimages/TransferScholarships.webp"
                    alt="Scholarship" class="rounded-full w-44 h-44 object-cover shadow-md" />
            </div>
            <div class="col-span-3 overflow-y-auto px-6 py-6 font-raleway overflow-y-scroll " id="side-panel">
                <div class="p-6 rounded-xl">
                    @if ($errors->any())
                        <script>
                            document.addEventListener('DOMContentLoaded', function () {
                                const sidebar = document.getElementById('sidebar');

                                // Open sidebar if closed
                                if (sidebar && sidebar.classList.contains('translate-x-full')) {
                                    sidebar.classList.remove('translate-x-full');
                                }
                            });
                        </script>
                        <div class="bg-red-200 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                            <strong>There were some problems with your input:</strong>
                            <ul class="mt-2 list-disc pl-5">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <h4 class="text-3xl font-bold mb-2 font-raleway">Scholarship Application Form</h4>
                    <p class="mb-4 text-sm text-gray-600">To apply for a CIAT scholarship, please follow the steps
                        below:
                    </p>
                    <ul class="list-disc list-inside text-sm text-gray-700 mb-4 space-y-1">
                        <li>
                            Review the eligibility guidelines and select from one of our available scholarships
                        </li>
                        <li>
                            Complete the scholarship application form below with the required documentation for your
                            selected
                            scholarship.
                        </li>
                        <ul>
                </div>

                <form class="flex flex-col gap-y-8 mt-4 mb-8" method="POST" id="scholarshipForm"
                    action="{{ route('scholarship.saveData') }}">
                    @csrf
                    <div class="flex flex-col gap-y-4">
                        <label for="scholarshipType" class="block font-raleway font-bold text-sm">
                            Scholarship Type
                            <span class="text-red-500" aria-hidden="true">*</span>
                            <span class="sr-only">required</span>
                        </label>
                        <!-- <select name="scholarshipType" required> -->
                        <select id="scholarshipType" name="scholarshipType" required="" aria-required="true"
                            class="bg-gray-400 rounded-md shadow-md p-2 w-full transition focus:ring-2 focus:ring-blue-500 focus:ring-offset-1 focus:outline-none">
                            <option value="">Choose a Scholarship</option>
                            @foreach ($scholarshipOptions as $value => $label)
                                <option value="{{ $value }}">{{ $label }}</option>`
                            @endforeach
                        </select>
                    </div>
                    <fieldset>
                        <legend class="font-raleway font-bold text-sm mb-2">
                            Have you ever attended CIAT before? <span class="text-red-500" aria-hidden="true">*</span>
                        </legend>
                        <div class="flex flex-col gap-y-4">
                            <div class="grid grid-cols-2 gap-4 my-4 items-stretch">
                                <div class="h-full">
                                    <input id="newOrReEntry-newStudent" type="radio" name="newOrReEntry"
                                        value="newStudent" class="sr-only peer">
                                    <label for="newOrReEntry-newStudent"
                                        class="h-full flex items-center justify-center cursor-pointer rounded-full border border-sky-500 px-6 py-4 text-center text-sm font-medium transition duration-200 peer-checked:bg-sky-500 peer-checked:text-white hover:bg-sky-500 hover:text-white focus-within:ring-2 focus-within:ring-blue">
                                        <span class="block w-full">
                                            No, I am a new student
                                        </span>
                                    </label>
                                </div>
                                <div class="h-full">
                                    <input id="newOrReEntry-reentryStudent" type="radio" name="newOrReEntry"
                                        value="reentryStudent" class="sr-only peer">
                                    <label for="newOrReEntry-reentryStudent"
                                        class="h-full flex items-center justify-center cursor-pointer rounded-full border border-sky-500 px-6 py-4 text-center text-sm font-medium transition duration-200 peer-checked:bg-sky-500 peer-checked:text-white hover:bg-sky-500 hover:text-white focus-within:ring-2 focus-within:ring-blue">
                                        <span class="block w-full">
                                            Yes, I have attended CIAT before
                                        </span>
                                    </label>
                                </div>

                            </div>
                        </div>
                    </fieldset>
                    <div class="flex flex-col gap-y-4 lg:grid lg:grid-cols-2 lg:gap-x-4">
                        <div class="flex flex-col gap-y-4">
                            <label for="firstName" class="block font-raleway font-bold text-sm">
                                First Name
                                <span class="text-red-500" aria-hidden="true">*</span>
                                <span class="sr-only">required</span>
                            </label>
                            <input id="firstName" name="firstName" type="text" value="" placeholder="" required=""
                                aria-required="true"
                                class="bg-gray-400  rounded-md shadow-md p-2 w-full focus:outline-blue focus:ring-2 focus:ring-offset-1">
                        </div>
                        <div class="flex flex-col gap-y-4">
                            <label for="lastName" class="block font-raleway font-bold text-sm">
                                Last Name
                                <span class="text-red-500" aria-hidden="true">*</span>
                                <span class="sr-only">required</span>

                            </label>

                            <input id="lastName" name="lastName" type="text" value="" placeholder="" required=""
                                aria-required="true"
                                class="bg-gray-400  rounded-md shadow-md p-2 w-full focus:outline-blue focus:ring-2 focus:ring-offset-1">
                        </div>
                    </div>
                    <div class="flex flex-col gap-y-4 lg:grid lg:grid-cols-2 lg:gap-x-4">
                        <div class="flex flex-col gap-y-4">
                            <label for="emailAddress" class="block font-raleway font-bold text-sm">
                                E-mail Address
                                <span class="text-red-500" aria-hidden="true">*</span>
                                <span class="sr-only">required</span>

                            </label>

                            <input id="emailAddress" name="emailAddress" type="email" value="" placeholder=""
                                required="" aria-required="true" data-dd-privacy="mask-user-input"
                                class="bg-gray-400  rounded-md shadow-md p-2 w-full focus:outline-blue focus:ring-2 focus:ring-offset-1">


                        </div>
                        <div class="flex flex-col gap-y-4">
                            <label for="phoneNumber" class="block font-raleway font-bold text-sm">
                                Phone
                                <span class="text-red-500" aria-hidden="true">*</span>
                                <span class="sr-only">required</span>

                            </label>

                            <input id="phoneNumber" name="phoneNumber" type="tel" value="" placeholder="" required=""
                                aria-required="true"
                                class="bg-gray-400  rounded-md shadow-md p-2 w-full focus:outline-blue focus:ring-2 focus:ring-offset-1">
                        </div>
                    </div>
                    <div class="flex flex-col gap-4">
                        <label for="streetAddress" class="font-raleway font-bold text-sm">Street Address*</label>
                        <div class="relative">
                            <input type="text"
                                class="bg-gray-400  rounded-md shadow-md p-2 outline-none border-none focus:outline-blue transition duration-300 ease-in-out min-w-full"
                                id="streetAddress" name="streetAddress" required="">
                        </div>
                    </div>
                    <div class="flex flex-col gap-y-8 col-span-2 lg:grid lg:grid-cols-3 lg:gap-x-4">
                        <div class="flex flex-col gap-y-4">
                            <label for="city" class="block font-raleway font-bold text-sm">
                                City
                                <span class="text-red-500" aria-hidden="true">*</span>
                                <span class="sr-only">required</span>

                            </label>

                            <input id="city" name="city" type="text" value="" placeholder="" required=""
                                aria-required="true"
                                class="bg-gray-400  rounded-md shadow-md p-2 w-full focus:outline-blue focus:ring-2 focus:ring-offset-1">


                        </div>
                        <div class="flex flex-col gap-y-4">
                            <label for="state" class="block font-raleway font-bold text-sm">
                                State
                                <span class="text-red-500" aria-hidden="true">*</span>
                                <span class="sr-only">required</span>
                            </label>

                            <select id="state" name="state" required="" aria-required="true"
                                class="bg-gray-400  rounded-md shadow-md p-2 w-full focus:outline-blue focus:ring-2 focus:ring-offset-1">
                                <option value="">Choose a State</option>
                                @foreach ($stateOptions as $value => $label)
                                    <option value="{{ $value }}">{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="flex flex-col gap-y-4">
                            <label for="zipCode" class="block font-raleway font-bold text-sm">
                                Zip Code
                                <span class="text-red-500" aria-hidden="true">*</span>
                                <span class="sr-only">required</span>
                            </label>

                            <input id="zipCode" name="zip" type="text" value="" placeholder="" required=""
                                aria-required="true"
                                class="bg-gray-400  rounded-md shadow-md p-2 w-full focus:outline-blue focus:ring-2 focus:ring-offset-1">
                        </div>
                    </div>
                    <div class="flex flex-col gap-y-4">
                        <label for="programInterest" class="block font-raleway font-bold text-sm">
                            Choose Program Interest
                            <span class="text-red-500" aria-hidden="true">*</span>
                            <span class="sr-only">required</span>
                        </label>

                        <select id="programInterest" name="programInterest" required="" aria-required="true"
                            class="bg-gray-400  rounded-md shadow-md p-2 w-full focus:outline-blue focus:ring-2 focus:ring-offset-1">
                            <option value="">Select a Program Interest</option>
                            @foreach ($programOptions as $value => $label)
                                <option value="{{ $value }}">{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex flex-col gap-y-4">
                        <label for="admissionsAdvisor" class="block font-raleway font-bold text-sm">
                            Who is your Admissions Advisor?
                            <span class="text-red-500" aria-hidden="true">*</span>
                            <span class="sr-only">required</span>
                        </label>

                        <select id="admissionsAdvisor" name="admissionsAdvisor" required="" aria-required="true"
                            class="bg-gray-400  rounded-md shadow-md p-2 w-full focus:outline-blue focus:ring-2 focus:ring-offset-1">
                            <option value="">Choose an Admissions Advisor</option>
                            @foreach ($advisorOptions as $value => $label)
                                <option value="{{ $value }}">{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex flex-col gap-y-8 my-4">
                        <label for="signature" class="font-raleway font-bold text-sm">
                            I agree that this document may be electronically signed and that the electronic signatures
                            on
                            this document
                            are the same as handwritten signatures for purposes of validity, enforceability and
                            admissibility.
                        </label>

                        <div class="grid grid-cols-1 gap-4 my-4 items-stretch">
                            <div class="h-full">
                                <input id="yesSign" type="radio" name="agreeSignature" value="1" class="hidden peer">

                                <label for="yesSign"
                                    class="h-full flex flex-col justify-center rounded-md border border-sky-500 px-8 py-4 shadow-md cursor-pointer hover:bg-sky-500 hover:text-white peer-checked:bg-sky-500 peer-checked:text-white transition duration-200 ease-in-out">
                                    <span class="font-bold text-xs">Yes, I understand and agree</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-col gap-y-8 my-4">
                        <label for="agreesms" class="font-raleway font-bold text-sm">
                            By checking this box, you agree to receive SMS messages from our organization regarding our
                            services.
                        </label>

                        <div class="grid grid-cols-1 gap-4 my-4 items-stretch">

                            <div class="h-full">
                                <input id="yesSMS" type="radio" name="agreeSMS" value="1" class="hidden peer">
                                <label for="yesSMS"
                                    class="h-full flex flex-col justify-center rounded-md border border-sky-500 px-8 py-4 shadow-md cursor-pointer hover:bg-sky-500 hover:text-white peer-checked:bg-sky-500 peer-checked:text-white transition duration-200 ease-in-out">
                                    <span class="font-bold text-xs">I agree to receive SMS messages</span>
                                </label>
                            </div>

                        </div>

                    </div>

                    <div class="flex flex-col gap-4">
                        <label for="signatureData-canvas" class="font-raleway font-bold text-sm">
                            Signature of Student<span class="text-red-500" x-show="1">*</span>
                        </label>
                        <div id="signature-container" class="relative border border-black bg-white">
                            <canvas id="signatureData-canvas" width="335" height="254"
                                class="signatureCanvas w-full h-32 sm:h-64 bg-white gb-blur-large-empty-element"></canvas>
                            <input type="text" name="signatureTextInput" id="signatureTextInput"
                                placeholder="Type your signature here" autocomplete="off" spellcheck="false" class="
                                        absolute top-1/2 left-5 -translate-y-1/2
                                        w-[calc(100%-40px)]
                                        bg-transparent border-0 outline-none
                                        text-black caret-black select-text cursor-text
                                        text-[48px] font-[cursive]
                                        overflow-x-auto whitespace-nowrap pr-[20px]
                                        hidden
                            " />
                        </div>
                        <input type="hidden" id="signatureData" />
                        <div class="mt-4 space-x-4 flex justify-end">
                            <button id="modeToggleBtn" type="button"
                                class="text-sky-500 font-semibold rounded cursor-pointer underline">
                                Switch to Text Mode
                            </button>

                            <button id="clear" type="button"
                                class="text-red-400 font-semibold rounded cursor-pointer underline">
                                Clear
                            </button>
                        </div>
                    </div>
                    <div class="flex flex-col gap-4">
                        <label for="dateSigned" class="text-sm font-bold font-raleway">Date Signed*</label>
                        <input type="date" name="dateSigned"
                            class="bg-gray-400  rounded-md shadow-md p-2 outline-none border-none focus:outline-blue transition duration-300 ease-in-out min-w-[20vw] xl:min-w-[25vw]"
                            value="{{ \Carbon\Carbon::now()->toDateString() }}"
                            defaultValue="{{ \Carbon\Carbon::now()->toDateString() }}" readonly />
                    </div>
                    <p class="text-xs text-[#B1B1B1]">* By submitting this form, you are giving your express written
                        consent for
                        California Institute of Applied Technology to contact you regarding our educational programs and
                        services using
                        email, telephone or text – including our use of automated technology for calls and periodic
                        texts to
                        any
                        wireless number you provide. Message and data rates may apply. This consent is not required to
                        purchase goods or
                        services and you may always call us directly at 877-559-3621. You can opt-out at any time by
                        calling
                        us or
                        responding STOP to any text message.
                    </p>

                    <button type="submit"
                        class="py-2 px-8 bg-sky-600 text-sm font-raleway shadow-md cursor-pointer border rounded-full transition duration-700 ease-in-out font-medium text-white border-sky-500 hover:bg-white hover:text-sky-500">
                        Apply for Scholarship
                    </button>
                    @if (session('success'))
                    <script>
                        alert("The form data has been saved successfully!")
                    </script>
                    @endsession
                </form>
            </div>
        </div>

    </div>
</body>

</html>