<?php



// app/Http/Controllers/APIAuthController.php



namespace App\Http\Controllers;



use App\Http\Resources\UserResource;

use App\Models\User;

use App\Models\Customer;

use App\Models\CrewMember;

use App\Models\TaskComment;
use App\Models\MeterReading;

use App\Models\Crew;
use App\Models\AssigmentMeters;
use App\Models\CustomerLocation;



use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;



class APIAuthController extends Controller

{

    // Login

    public function login(Request $request)

    {

        $credentials = $request->validate([

            'email' => 'required|email',

            'password' => 'required',

        ]);



        if (Auth::attempt($credentials)) {

            $user = Auth::user();

            $token = $user->createToken('authToken')->plainTextToken;



            return response()->json([

                'user' => $user,

                'token' => $token,

            ]);
        }



        return response()->json(['error' => 'Unauthorized'], 401);
    }



    // Logout

    public function logout(Request $request)

    {

        $request->user()->tokens()->delete();



        return response()->json(['message' => 'Logged out successfully']);
    }



    // public function getUserTasks()

    // {

    //     $user = Auth::user();

    //     $tasks = $user->assignedTasks()->with('serviceOrder', 'assignedBy', 'assignedTo')->get();



    //     return response()->json($tasks);

    // }



    public function getUserTasks(User $user)

    {



        $tasks = $user->assignedTasks()->with('serviceOrder', 'assignedBy', 'assignedTo')->get();



        return response()->json($tasks);
    }

    public function getMeterReadings(User $user)
    {
        // Assuming you have defined the relationships in the User model
        $meterAssignmentsWithMetersAndAdditionalData = $user->meterAssignments;

        return response()->json($meterAssignmentsWithMetersAndAdditionalData);
    }

    public function getMeterReadingDetail($id)

    {

        $meters = AssigmentMeters::where('assign_id', $id)->with('meter')->get();

        return response()->json($meters);
    }

    public function addMeterReading(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'readings' => 'required|numeric', // Adjust validation rules as needed
                'comment' => 'nullable|string',
                'anomaly' => 'nullable|string',
                'same_meter' => 'nullable|string',
                'energy_reading' => 'nullable|string',
                'reading_unit' => 'nullable|string',
                'assign_id' => 'required|numeric',
            ]);

            $meterReading = new MeterReading();
            $meterReading->readings = $validatedData['readings'];
            $meterReading->comment = $validatedData['comment'];
            $meterReading->anomaly = $validatedData['anomaly'];
            $meterReading->same_meter = $validatedData['same_meter'];
            $meterReading->energy_reading = $validatedData['energy_reading'];
            $meterReading->reading_unit = $validatedData['reading_unit'];
            $meterReading->assign_id = $validatedData['assign_id'];
            $meterReading->save();

            return response()->json(['message' => 'Meter reading added successfully'], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred'], 500);
        }
    }

    public function getMeterCustomer($id)

    {

        $customer = Customer::where('cnumber', $id)->first();

        return response()->json($customer);
    }


    public function getUserMessages(User $user)

    {



        $tasks = $user->receivedEmails()->with('attachments', 'sender')->get();



        return response()->json($tasks);
    }



    public function getTaskComments(Request $request)

    {



        $comments = TaskComment::where('task_id', $request->taskId)->with('sender')->get();



        return response()->json($comments);
    }



    public function getUserCrew(User $user)

    {



        $userCrew = CrewMember::where('member_id', $user->employee_id)->first();

        $crew = $userCrew->crew;



        $crewMembers = CrewMember::where('crew_id', $userCrew->crew_id)->with('user')->get();



        $supervisor = Crew::where('id', $userCrew->crew_id)->first();



        $crewSupervisor = $supervisor->supervisor;



        return response()->json(['crew' => $crew, 'supervisor' => $crewSupervisor, 'members' => $crewMembers]);
    }



    public function getCustomer(Customer $customer)
    {
        $customerWithMeters = $customer->load('meters'); // Load the meters relationship

        if ($customerWithMeters) {
            return response()->json($customerWithMeters);
        } else {
            return response()->json(['error' => 'No Customer Connected to this Service Order'], 401);
        }
    }



    public function getCrewTasks(Crew $crew)

    {

        if ($crew) {

            return response()->json($crew);
        } else {

            return response()->json(['error' => 'No Customer Connected to this Service Order'], 401);
        }
    }

    public function getUsers()

    {

        $users = User::all();



        if ($users) {

            return response()->json($users);
        } else {

            return response()->json(['error' => 'No User'], 401);
        }
    }

    public function customers()
    {
        // Retrieve all customers from the database
        $customers = Customer::all();

        // Return the customers as JSON
        return response()->json($customers);
    }
    public function updateCustomerLocation(Request $request)
    {
        // // Retrieve customer ID, latitude, and longitude from the request
        $customerId = $request->input('customer_id');
        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');

        // // Save the converted coordinates to the customer_locations table
        $location = new CustomerLocation();
        $location->cnumber = $customerId;
        $location->latitude = $latitude;
        $location->longitude = $longitude;
        $location->save();

        return response()->json(['message' => 'Coordinates saved successfully']);
    }
}
