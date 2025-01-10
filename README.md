# Requiem
### Goal
- Make calls simple to construct and read.
- A structure that is difficult misuse.
- Permit for presets: headers, auth, method, root, content type, etc.
- Permit for easy platform customization, twilio, Google Maps, Uber etc.
- Enable a unified response structure: error, response payload payload, etc.

## Classes
### Requiem class
- Implements RequiemApi and defaults the request/response drivers.

### RequiemApi class
The primary class used to make rest endpoint calls. Extend this if you want to preset items.
- Add headers
- Add methods
- Add body payload
- Add root
- Add rout
- Join root/route
- Make the request
- Return the response
- Report errors if provided
- Set RequestDriver
- Set ResponseDriver

### RequiemGuzzle
- Converts the data from RequiemApi in to a proper Guzzle Call and calls it.
- Returns all data from the response and returns it to the RequiemApi class.

### RequiemError
- Sets error code
- Sets error message
- Sets data to collect any other info

### RequiemResponse
- Sets RequiemError if it can.
- Converts response body into a php array/object.

### RequiemRequestDefault
- Presets
  - get
  - application json
  - rout is full url
  - 
