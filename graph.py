import mysql.connector
import plotly.express as px
import re

# Read the PHP file containing the database connection details
with open('server/configure.php', 'r') as php_file:
    php_content = php_file.read()

# Extract connection information using regular expressions
host_match = re.search(r"mysql:host=(.*?);", php_content)
dbname_match = re.search(r"dbname=(.*?);", php_content)

if host_match and dbname_match:
    host = host_match.group(1)
    dbname = dbname_match.group(1)
    dbname = dbname.strip('"')
else:
    print("Connection information not found in PHP file.")

# Read the PHP file containing the database credentials
with open('server/conn_info.php', 'r') as php_file:
    credentials_content = php_file.read()

# Extract username and password using regular expressions
username_match = re.search(r"define\('DBUSER',\s*'([^']+)'\);", credentials_content)
password_match = re.search(r"define\('DBPASS',\s*'([^']+)'\);", credentials_content)

if username_match and password_match:
    user = username_match.group(1)
    password = password_match.group(1)
else:
    print("Database credentials not found in PHP file.")

# Establish connection to the database
conn = mysql.connector.connect(
    host=host,
    user=user,
    password=password,
    database=dbname
)

# Create a cursor object to execute SQL queries
cursor = conn.cursor()

# Execute SQL query to retrieve the number of sign-ups per month
cursor.execute("SELECT MONTH(dateJoined), COUNT(*) FROM USER GROUP BY MONTH(dateJoined)")

# Fetch all rows of the result
rows = cursor.fetchall()

# Separate months and sign-ups from the fetched data
months = ["January","February","March","April","May","June","July","August","September","October","November","December"]
signups = [0] * 12  # Initialize signups list with zeros for each month

# Update signups list with counts from fetched data
for row in rows:
    month_index = row[0] - 1  # Month index (0-based) based on SQL query result (1-12)
    signups[month_index] = row[1]  # Update signups count for the corresponding month

# Create a Plotly Express bar plot
fig = px.line(x=months, y=signups, labels={'x':'Month', 'y':'Number of Sign-ups'})
fig.update_xaxes(tickangle=45)  # Rotate x-axis labels for better readability
# Update the layout to remove grids and change the color to red
# fig.update_layout(
#     xaxis=dict(showgrid=False),  # Remove x-axis grid
#     yaxis=dict(showgrid=False),  # Remove y-axis grid
#     plot_bgcolor='rgba(0, 0, 0, 0)',  # Set plot background color to transparent
#     paper_bgcolor='rgba(0, 0, 0, 0)',  # Set paper background color to transparent
# )
# fig.update_traces(line_color="red")

# Save the plot as an HTML file
fig.write_html('plot.html')

print("HTML graph saved to plot.html")
