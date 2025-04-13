<?php
// server.php

class MySoapServer {
    /**
     * Adds two numbers together.
     *
     * @param int $a The first number.
     * @param int $b The second number.
     * @return int The sum of $a and $b.
     */
    public function add(int $a, int $b): int {
        return $a + $b;
    }

    /**
     * Concatenates two strings.
     *
     * @param string $str1 The first string.
     * @param string $str2 The second string.
     * @return string The concatenated string.
     */
    public function concatenate(string $str1, string $str2): string {
        return $str1 . $str2;
    }

    /**
     * Greets the user by name.
     *
     * @param string $name The name of the user.
     * @return string A greeting message.
     */
    public function greet(string $name): string {
        return "Hello, " . $name . "!";
    }
}

// Initialize the SOAP server
$server = new SoapServer(
    null, // No WSDL file for now (we'll use non-WSDL mode)
    [
        'uri' => 'http://localhost/soap-server', // Replace with your server's URI
    ]
);

// Set the class that will handle the requests
$server->setClass('MySoapServer');

// Handle the request
$server->handle();
?>

<?php
// Calculator.php
class Calculator {
    /**
     * Adds two numbers.
     *
     * @param int $a The first number.
     * @param int $b The second number.
     * @return int The sum.
     */
    public function add(int $a, int $b): int {
        return $a + $b;
    }

    /**
     * Subtracts two numbers.
     *
     * @param int $a The first number.
     * @param int $b The second number.
     * @return int The difference.
     */
    public function subtract(int $a, int $b): int {
        return $a - $b;
    }
}

// Greeter.php
class Greeter {
    /**
     * Greets a person by name.
     *
     * @param string $name The person's name.
     * @return string The greeting message.
     */
    public function greet(string $name): string {
        return "Hello, " . $name . "!";
    }

    /**
     * Says goodbye to a person by name.
     *
     * @param string $name The person's name.
     * @return string The goodbye message.
     */
    public function goodbye(string $name): string {
        return "Goodbye, " . $name . "!";
    }
}
?>
//----------------------------------------
<?php
// Calculator.php
class Calculator {
    /**
     * Adds two numbers.
     *
     * @param int $a The first number.
     * @param int $b The second number.
     * @return int The sum.
     */
    public function add(int $a, int $b): int {
        return $a + $b;
    }

    /**
     * Subtracts two numbers.
     *
     * @param int $a The first number.
     * @param int $b The second number.
     * @return int The difference.
     */
    public function subtract(int $a, int $b): int {
        return $a - $b;
    }
}

// Greeter.php
class Greeter {
    /**
     * Greets a person by name.
     *
     * @param string $name The person's name.
     * @return string The greeting message.
     */
    public function greet(string $name): string {
        return "Hello, " . $name . "!";
    }

    /**
     * Says goodbye to a person by name.
     *
     * @param string $name The person's name.
     * @return string The goodbye message.
     */
    public function goodbye(string $name): string {
        return "Goodbye, " . $name . "!";
    }
}
?>

<?php
// server.php

// Include the class files
require_once 'Calculator.php';
require_once 'Greeter.php';

class MySoapServer {
    private $calculator;
    private $greeter;

    public function __construct() {
        $this->calculator = new Calculator();
        $this->greeter = new Greeter();
    }

    /**
     * Adds two numbers using the Calculator class.
     *
     * @param int $a The first number.
     * @param int $b The second number.
     * @return int The sum.
     */
    public function add(int $a, int $b): int {
        return $this->calculator->add($a, $b);
    }

    /**
     * Subtracts two numbers using the Calculator class.
     *
     * @param int $a The first number.
     * @param int $b The second number.
     * @return int The difference.
     */
    public function subtract(int $a, int $b): int {
        return $this->calculator->subtract($a, $b);
    }

    /**
     * Greets a person using the Greeter class.
     *
     * @param string $name The person's name.
     * @return string The greeting message.
     */
    public function greet(string $name): string {
        return $this->greeter->greet($name);
    }

    /**
     * Says goodbye to a person using the Greeter class.
     *
     * @param string $name The person's name.
     * @return string The goodbye message.
     */
    public function goodbye(string $name): string {
        return $this->greeter->goodbye($name);
    }
}

// Initialize the SOAP server
$server = new SoapServer(
    null, // No WSDL file for now (non-WSDL mode)
    [
        'uri' => 'http://localhost/soap-server', // Replace with your server's URI
    ]
);

// Set the class that will handle the requests
$server->setClass('MySoapServer');

// Handle the request
$server->handle();
?>
<?php
// client.php

try {
    // Initialize the SOAP client
    $client = new SoapClient(
        null, // No WSDL file for now (non-WSDL mode)
        [
            'location' => 'http://localhost/server.php', // Replace with your server's URL
            'uri' => 'http://localhost/soap-server', // Replace with your server's URI
            'trace' => 1, // Enable tracing for debugging
        ]
    );

    // Call the 'add' function
    $sum = $client->add(10, 5);
    echo "Sum: " . $sum . "\n";

    // Call the 'subtract' function
    $difference = $client->subtract(20, 8);
    echo "Difference: " . $difference . "\n";

    // Call the 'greet' function
    $greeting = $client->greet("Bob");
    echo "Greeting: " . $greeting . "\n";

    // Call the 'goodbye' function
    $farewell = $client->goodbye("Bob");
    echo "Farewell: " . $farewell . "\n";

    // Optional: Print the last request and response for debugging
    echo "\nLast Request:\n";
    echo $client->__getLastRequest() . "\n";
    echo "\nLast Response:\n";
    echo $client->__getLastResponse() . "\n";

} catch (SoapFault $e) {
    echo "Error: " . $e->getMessage() . "\n";
    // Optional: Print the last request and response for debugging
    echo "\nLast Request:\n";
    echo $client->__getLastRequest() . "\n";
    echo "\nLast Response:\n";
    echo $client->__getLastResponse() . "\n";
}
?>
//======sms token
<?php

// OTP.php (OTP Class - You can put this in a separate file or include it here)
class OTP
{
    private $apiKey;
    private $apiUrl = 'https://sms.arkesel.com/api/otp/';

    public function __construct(string $apiKey)
    {
        if (empty($apiKey)) {
            throw new SoapFault('401', "Authentication failed (Missing or Invalid key)");
        }
        $this->apiKey = $apiKey;
    }

    public function generate(array $data): array
    {
        $requiredFields = ['expiry', 'length', 'medium', 'message', 'number', 'sender_id', 'type'];
        foreach ($requiredFields as $field) {
            if (!isset($data[$field])) {
                throw new SoapFault('422', "Validation error (Missing required field: $field)");
            }
        }

        if (!strpos($data['message'], '%otp_code%')) {
            throw new SoapFault('1002', "Message must contain a slot for otp code, like %otp_code%");
        }

        $response = $this->sendRequest('generate', $data);
        return $this->processResponse($response, 'generate');
    }

    public function verify(array $data): array
    {
        $requiredFields = ['code', 'number'];
        foreach ($requiredFields as $field) {
            if (!isset($data[$field])) {
                throw new SoapFault('422', "Validation error (Missing required field: $field)");
            }
        }

        $response = $this->sendRequest('verify', $data);
        return $this->processResponse($response, 'verify');
    }

    private function sendRequest(string $endpoint, array $data): string
    {
        $postvars = http_build_query($data);

        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => $this->apiUrl . $endpoint,
            CURLOPT_HTTPHEADER => ['api-key: ' . $this->apiKey],
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 10,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_POST => 1,
            CURLOPT_POSTFIELDS => $postvars,
        ]);

        $response = curl_exec($curl);
        $error = curl_error($curl);
        curl_close($curl);

        if ($error) {
            throw new SoapFault('500', "cURL Error #:" . $error);
        }

        return $response;
    }

    private function processResponse(string $response, string $operation): array
    {
        $decodedResponse = json_decode($response, true);

        if ($decodedResponse === null) {
            throw new SoapFault(($operation === 'generate' ? '1011' : '1106'), "Internal error");
        }

        if (isset($decodedResponse['code'])) {
            $code = $decodedResponse['code'];
            switch ($code) {
                case '1000':
                    return ['code' => 1000, 'message' => 'Successful, Message delivered', 'data' => $decodedResponse];
                case '1001':
                    throw new SoapFault('1001', $decodedResponse['message']);
                case '1003':
                    throw new SoapFault('1003', 'This Sender ID have Blocked By Administrator');
                case '1004':
                    throw new SoapFault('1004', 'SMS gateway not active or credential not found');
                case '1005':
                    throw new SoapFault('1005', 'Invalid phone number');
                case '1006':
                    throw new SoapFault('1006', 'OTP is not allowed in your Country');
                case '1007':
                    throw new SoapFault('1007', 'Insufficient balance');
                case '1008':
                    throw new SoapFault('1008', 'Insufficient balance');
                case '1009':
                    throw new SoapFault('1009', 'You can not send more than 500 characters using voice medium');
                case '1100':
                    return ['code' => 1100, 'message' => 'Successful', 'data' => $decodedResponse];
                case '1101':
                    throw new SoapFault('1101', $decodedResponse['message']);
                case '1102':
                    throw new SoapFault('1102', 'Invalid phone number');
                case '1103':
                    throw new SoapFault('1103', 'Invalid phone number');
                case '1104':
                    throw new SoapFault('1104', 'Invalid code');
                case '1105':
                    throw new SoapFault('1105', 'Code has expired');
                default:
                    throw new SoapFault(($operation === 'generate' ? '1011' : '1106'), "Internal error");
            }
        } else {
            throw new SoapFault(($operation === 'generate' ? '1011' : '1106'), "Internal error");
        }
    }
}

// server.php (SOAP Server)
class SoapOtpServer
{
    private $otp;

    public function __construct(string $apiKey)
    {
        $this->otp = new OTP($apiKey);
    }

    /**
     * Generates an OTP.
     *
     * @param array $data The data for OTP generation.
     * @return array The response from the API.
     * @throws SoapFault If there is an error.
     */
    public function generateOtp(array $data): array
    {
        return $this->otp->generate($data);
    }

    /**
     * Verifies an OTP.
     *
     * @param array $data The data for OTP verification.
     * @return array The response from the API.
     * @throws SoapFault If there is an error.
     */
    public function verifyOtp(array $data): array
    {
        return $this->otp->verify($data);
    }
}

// Initialize the SOAP server
try {
    $apiKey = 'cE9QRUkdjsjdfjkdsj9kdiieieififiw='; // Replace with your actual API key
    $server = new SoapServer(
        null, // No WSDL file for now (non-WSDL mode)
        [
            'uri' => 'http://localhost/soap-otp-server', // Replace with your server's URI
        ]
    );

    // Set the class that will handle the requests
    $server->setClass('SoapOtpServer', $apiKey);

    // Handle the request
    $server->handle();
} catch (SoapFault $e) {
    // Handle SOAP faults here (e.g., log the error, return a custom response)
    echo "SOAP Error: " . $e->getMessage() . "\n";
}
?>

<?php
// client.php

try {
    // Initialize the SOAP client
    $client = new SoapClient(
        null, // No WSDL file for now (non-WSDL mode)
        [
            'location' => 'http://localhost/server.php', // Replace with your server's URL
            'uri' => 'http://localhost/soap-otp-server', // Replace with your server's URI
            'trace' => 1, // Enable tracing for debugging
        ]
    );

    // Generate OTP
    $generateData = [
        'expiry' => 5,
        'length' => 6,
        'medium' => 'sms',
        'message' => 'This is OTP from Arkesel, %otp_code%',
        'number' => '233544919953',
        'sender_id' => 'Arkesel',
        'type' => 'numeric',
    ];
    $generateResponse = $client->generateOtp($generateData);
    echo "Generate OTP Response:\n";
    print_r($generateResponse);

    // Verify OTP
    $verifyData = [
        'code' => '173882', // Replace with the actual OTP code
        'number' => '233544919953',
    ];
    $verifyResponse = $client->verifyOtp($verifyData);
    echo "\nVerify OTP Response:\n";
    print_r($verifyResponse);

    // Optional: Print the last request and response for debugging
    echo "\nLast Request:\n";
    echo $client->__getLastRequest() . "\n";
    echo "\nLast Response:\n";
    echo $client->__getLastResponse() . "\n";

} catch (SoapFault $e) {
    echo "SOAP Error: " . $e->getMessage() . " (Code: " . $e->getCode() . ")\n";
    // Optional: Print the last request and response for debugging
    echo "\nLast Request:\n";
    echo $client->__getLastRequest() . "\n";
    echo "\nLast Response:\n";
    echo $client->__getLastResponse() . "\n";
}
?>
sms
<?php

namespace App\SMS;

class SMS
{
    private $apiKey;
    private $baseUrl = 'https://sms.arkesel.com/';

    /**
     * SMS constructor.
     *
     * @param string $apiKey The API key for authentication.
     * @throws \Exception If the API key is not provided.
     */
    public function __construct(string $apiKey)
    {
        if (empty($apiKey)) {
            throw new \Exception("API key is required.");
        }
        $this->apiKey = $apiKey;
    }

    /**
     * Sends an SMS message.
     *
     * @param string $to The recipient's phone number.
     * @param string $from The sender ID.
     * @param string $sms The message content.
     * @param string|null $useCase Optional: The use case for Nigerian contacts.
     * @return string The API response.
     * @throws \Exception If there is an error during the API request.
     */
    public function sendSMS(string $to, string $from, string $sms, string $useCase = null): string
    {
        $url = $this->baseUrl . 'sms/api?action=send-sms&api_key=' . urlencode($this->apiKey) . '&to=' . urlencode($to) . '&from=' . urlencode($from) . '&sms=' . urlencode($sms);

        if ($useCase) {
            $url .= '&use_case=' . urlencode($useCase);
        }

        return $this->sendRequest($url);
    }

    /**
     * Sends a scheduled SMS message.
     *
     * @param string $to The recipient's phone number.
     * @param string $from The sender ID.
     * @param string $sms The message content.
     * @param string $schedule The schedule date and time (e.g., "13-01-2021 05:30 PM").
     * @param string|null $useCase Optional: The use case for Nigerian contacts.
     * @return string The API response.
     * @throws \Exception If there is an error during the API request.
     */
    public function sendScheduledSMS(string $to, string $from, string $sms, string $schedule, string $useCase = null): string
    {
        $url = $this->baseUrl . 'sms/api?action=send-sms&api_key=' . urlencode($this->apiKey) . '&to=' . urlencode($to) . '&from=' . urlencode($from) . '&sms=' . urlencode($sms) . '&schedule=' . urlencode($schedule);

        if ($useCase) {
            $url .= '&use_case=' . urlencode($useCase);
        }

        return $this->sendRequest($url);
    }

    /**
     * Checks the account balance.
     *
     * @return string The API response.
     * @throws \Exception If there is an error during the API request.
     */
    public function checkBalance(): string
    {
        $url = $this->baseUrl . 'sms/api?action=check-balance&api_key=' . urlencode($this->apiKey) . '&response=json';
        return $this->sendRequest($url);
    }

    /**
     * Saves a contact.
     *
     * @param string $phoneBook The phone book name.
     * @param string $phoneNumber The contact's phone number.
     * @param string $firstName The contact's first name.
     * @param string $lastName The contact's last name.
     * @param string $email The contact's email.
     * @param string $company The contact's company.
     * @return string The API response.
     * @throws \Exception If there is an error during the API request.
     */
    public function saveContact(string $phoneBook, string $phoneNumber, string $firstName, string $lastName, string $email, string $company): string
    {
        $url = $this->baseUrl . 'contacts/api?action=subscribe-us&api_key=' . urlencode($this->apiKey) . '&phone_book=' . urlencode($phoneBook) . '&phone_number=' . urlencode($phoneNumber) . '&first_name=' . urlencode($firstName) . '&last_name=' . urlencode($lastName) . '&email=' . urlencode($email) . '&company=' . urlencode($company);
        return $this->sendRequest($url);
    }

    /**
     * Sends a request to the API.
     *
     * @param string $url The API URL.
     * @return string The API response.
     * @throws \Exception If there is an error during the API request.
     */
    private function sendRequest(string $url): string
    {
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 10,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ]);

        $response = curl_exec($curl);
        $error = curl_error($curl);
        curl_close($curl);

        if ($error) {
            throw new \Exception("cURL Error #:" . $error);
        }

        return $response;
    }
}

// Example usage:
try {
    $apiKey = 'cE9QRUkdjsjdfjkdsj9kdiieieififiw='; // Replace with your actual API key
    $sms = new SMS($apiKey);

    // Send SMS
    $sendResponse = $sms->sendSMS('233544919953', 'Arkesel', 'Hello world. Spreading peace and joy only. Remeber to put on your face mask. Stay safe!');
    echo "Send SMS Response:\n";
    echo $sendResponse . "\n\n";

    // Send Scheduled SMS
    $scheduleResponse = $sms->sendScheduledSMS('233544919953,233544919953', 'Arkesel', 'Hello world. Spreading peace and joy only. Remeber to put on your face mask. Stay safe!', '13-01-2021 05:30 PM');
    echo "Send Scheduled SMS Response:\n";
    echo $scheduleResponse . "\n\n";

    // Check Balance
    $balanceResponse = $sms->checkBalance();
    echo "Check Balance Response:\n";
    echo $balanceResponse . "\n\n";

    // Save Contact
    $saveContactResponse = $sms->saveContact('Most Recent Customers', '233544919953', 'Arkesel', 'Dev', 'support@arkesel.com', 'Take Care Inc.');
    echo "Save Contact Response:\n";
    echo $saveContactResponse . "\n\n";

    // Send SMS to Nigerian contact with use case
    $sendResponseNigeria = $sms->sendSMS('2349541111111', 'Arkesel', 'Hello world. Spreading peace and joy only. Remeber to put on your face mask. Stay safe!', 'promotional');
    echo "Send SMS to Nigerian contact Response:\n";
    echo $sendResponseNigeria . "\n\n";

    // Send Scheduled SMS to Nigerian contact with use case
    $scheduleResponseNigeria = $sms->sendScheduledSMS('2349541111111,2349542222222', 'Arkesel', 'Hello world. Spreading peace and joy only. Remeber to put on your face mask. Stay safe!', '13-01-2021 05:30 PM', 'promotional');
    echo "Send Scheduled SMS to Nigerian contact Response:\n";
    echo $scheduleResponseNigeria . "\n\n";

} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
//////////
<?php

/**
 * Class AssemblyAITranscriber
 *
 * This class provides an object-oriented interface for interacting with the AssemblyAI API
 * to transcribe audio files.
 */
class AssemblyAITranscriber
{
    private $apiKey;
    private $transcriptEndpoint = "https://api.assemblyai.com/v2/transcript";

    /**
     * AssemblyAITranscriber constructor.
     *
     * @param string $apiKey The AssemblyAI API key.
     * @throws Exception If the API key is not provided.
     */
    public function __construct(string $apiKey)
    {
        if (empty($apiKey)) {
            throw new Exception("API key is required.");
        }
        $this->apiKey = $apiKey;
    }

    /**
     * Submits an audio file for transcription.
     *
     * @param string $fileUrl The URL of the audio file to transcribe.
     * @return array The response from the API.
     * @throws Exception If there is an error during the API request.
     */
    public function submitForTranscription(string $fileUrl): array
    {
        $data = ["audio_url" => $fileUrl];
        $headers = [
            "authorization: {$this->apiKey}",
            "content-type: application/json",
        ];

        $response = $this->sendRequest($this->transcriptEndpoint, "POST", $data, $headers);
        return json_decode($response, true);
    }

    /**
     * Polls the API for the transcription result.
     *
     * @param string $transcriptId The ID of the transcript to poll.
     * @return array The transcription result.
     * @throws Exception If the transcription fails or if there is an error during the API request.
     */
    public function pollForTranscription(string $transcriptId): array
    {
        $pollingEndpoint = "https://api.assemblyai.com/v2/transcript/" . $transcriptId;
        $headers = [
            "authorization: {$this->apiKey}",
        ];

        while (true) {
            $response = $this->sendRequest($pollingEndpoint, "GET", [], $headers);
            $transcriptionResult = json_decode($response, true);

            if ($transcriptionResult['status'] === "completed") {
                return $transcriptionResult;
            } elseif ($transcriptionResult['status'] === "error") {
                throw new Exception("Transcription failed: " . $transcriptionResult['error']);
            } else {
                sleep(3);
            }
        }
    }

    /**
     * Sends a request to the API.
     *
     * @param string $url The API URL.
     * @param string $method The HTTP method (GET, POST).
     * @param array $data The request data.
     * @param array $headers The request headers.
     * @return string The API response.
     * @throws Exception If there is an error during the API request.
     */
    private function sendRequest(string $url, string $method, array $data, array $headers): string
    {
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        if ($method === "POST") {
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
        }

        $response = curl_exec($curl);
        $error = curl_error($curl);
        curl_close($curl);

        if ($error) {
            throw new Exception("cURL Error #:" . $error);
        }

        return $response;
    }
}

// Example usage:
try {
    $apiKey = "f1699c849f05473e8494a15d1253f955"; // Replace with your actual API key
    $fileUrl = "https://assembly.ai/wildfires.mp3"; // Replace with your file URL

    $transcriber = new AssemblyAITranscriber($apiKey);
    $submissionResponse = $transcriber->submitForTranscription($fileUrl);
    $transcriptId = $submissionResponse['id'];

    $transcriptionResult = $transcriber->pollForTranscription($transcriptId);
    echo $transcriptionResult['text'];
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}

?>
