## Function: `getCurrentAlbumArt`

- **Purpose**: Fetches the current song's album art for a specific radio station from an AzuraCast server.

- **Parameters**:
  - `$azuraCastBaseUrl`: The base URL of the AzuraCast server.
  - `$stationId`: The ID of the station. Defaults to `1`.

- **Process**:
  1. Constructs the endpoint URL to fetch the now playing data from AzuraCast.
  2. Makes a CURL request to this endpoint.
  3. Decodes the returned JSON data.
  4. Extracts the album art URL from the decoded data.

- **Returns**: 
  - The URL of the album art if it exists.
  - `false` if an error occurred or if the album art is not found.

## Main Script:

- Sets the `$azuraCastBaseUrl` to the provided AzuraCast server URL.
- Calls the `getCurrentAlbumArt` function to get the album art URL.
- If a valid album art URL is retrieved:
  - Fetches the content of the image using the URL.
  - Outputs the image with the appropriate content type header.
- If the image content cannot be fetched or the album art URL is not found, an error message is sent.

