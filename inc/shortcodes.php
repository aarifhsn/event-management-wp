<?php
function register_event_shortcode() {
    $html = '';
    if(isset($_SESSION['nonce_error']) && !empty($_SESSION['nonce_error'])) {
        $html .= '<div class="bg-red-50 p-4 mb-6 text-red-600">'.$_SESSION['nonce_error'].'</div>';
        unset($_SESSION['nonce_error']);
    }
    
    $html .= '<form method="POST" action="'.esc_url(admin_url('admin-post.php')).'">
        <div class="event_registration_form">
            <div class="mb-6">
                '.event_management_input(label: 'Team Name', name: 'team_name', type: 'text', required: true ).'
            </div>
            
            <h3 class="text-3xl uppercase my-6">COACH INFO</h3>

            <div class="flex gap-4">
                <div class="w-1/2">
                    '.event_management_input(label: 'Head Coach Full Name', name: 'head_coach_full_name', type: 'text', required: true).'
                </div>
                <div class="w-1/2">
                    '.event_management_input(label: 'Head coach mobile number', name: 'head_coach_mobile_number', type: 'tell', required: true).'
                </div>
            </div>
            <div class="w-full">
                '.event_management_input(label: 'Head Coach Email', name: 'head_coach_email', type: 'email', required: true).'
            </div>

            <div class="flex gap-4">
                <div class="w-1/2">
                    '.event_management_input(label: 'Assistant Coach Full Name', name: 'assistant_coach_full_name', type: 'text').'
                </div>
                <div class="w-1/2">
                    '.event_management_input(label: 'Assistant coach mobile number', name: 'assistant_coach_mobile_number', type: 'tell').'
                </div>
            </div>
            <div class="w-full">
                '.event_management_input(label: 'Assistant Coach Email', name: 'assistant_coach_email', type: 'email').'
            </div>

            <h3 class="text-3xl uppercase my-6">team info</h3>

            <div class="grid grid-cols-2 gap-4">
                <div class="">
                    '.event_management_input(label: 'City', name: 'city', type: 'text', required: true).'
                </div>
                <div class="">
                    '.event_management_input(label: 'State', name: 'state', type: 'select', required: true, options:[
                        "Bagerhat",
                        "Bandarban",
                        "Barguna",
                        "Barisal",
                        "Bhola",
                        "Bogra",
                        "Brahmanbaria",
                        "Chandpur",
                        "Chapai Nawabganj",
                        "Chittagong",
                        "Chuadanga",
                        "Comilla",
                        "Cox's Bazar",
                        "Dhaka",
                        "Dinajpur",
                        "Faridpur",
                        "Feni",
                        "Gaibandha",
                        "Gazipur",
                        "Gopalganj",
                        "Habiganj",
                        "Jaipurhat",
                        "Jamalpur",
                        "Jessore",
                        "Jhalokati",
                        "Jhenaidah",
                        "Joypurhat",
                        "Khagrachari",
                        "Khulna",
                        "Kishoreganj",
                        "Kurigram",
                        "Kushtia",
                        "Lakshmipur",
                        "Lalmonirhat",
                        "Madaripur",
                        "Magura",
                        "Manikganj",
                        "Meherpur",
                        "Moulvibazar",
                        "Munshiganj",
                        "Mymensingh",
                        "Naogaon",
                        "Narail",
                        "Narayanganj",
                        "Narsingdi",
                        "Natore",
                        "Netrokona",
                        "Nilphamari",
                        "Noakhali",
                        "Pabna",
                        "Panchagarh",
                        "Patuakhali",
                        "Pirojpur",
                        "Rajbari",
                        "Rajshahi",
                        "Rangamati",
                        "Rangpur",
                        "Satkhira",
                        "Shariatpur",
                        "Sherpur",
                        "Sirajganj",
                        "Sunamganj",
                        "Sylhet",
                        "Tangail",
                        "Thakurgaon"
                      ]).'
                </div>
                <div class="">
                    '.event_management_input(label: 'Select Pool play days', name: 'pool_play_days', type: 'select', required: true, options: [1,2,3,4,5,6,7,8,9,10]).'
                </div>
                <div class="">
                    '.event_management_input(label: 'age division', name: 'age_division', type: 'select', required: true, options:['9U', '8U']).'
                </div>
            </div>
        </div>

        <input type="hidden" name="registration_data_nonce" value="'.wp_create_nonce('registration_data_nonce').'">
        <input type="hidden" name="action" value="registration_data">
        <button type="submit" class="btn px-6 py-2 text-white mt-4">Save</button>
    </form>';

    return $html;
}

add_shortcode('register_event', 'register_event_shortcode');