from pprint import pprint

from googleapiclient import discovery
from oauth2client.client import GoogleCredentials

credentials = GoogleCredentials.get_application_default()

service = discovery.build('sqladmin', 'v1beta4', credentials=credentials)

# Project ID of the project that contains the instance.
project = 'project-id'  # UPDATE WITH YOUR project-id

# Cloud SQL instance ID. This does not include the project ID.
instance = 'vivanaturals-mysql'  # UPDATE WITH YOUR instance name

# NOTE: UPDATE uri to your filename on google cloud, database to your CGP db, table to your table name
instances_import_request_body = {
    "importContext": {
      "kind": "sql#importContext",
      "fileType": "csv",
      "uri": "gs://directory/filename.csv",
      "database": "database_name",
      "csvImportOptions": {
        "table": "table_name"
      }
    }
}

request = service.instances().import_(project=project, instance=instance, body=instances_import_request_body)
response = request.execute()

pprint(response)

