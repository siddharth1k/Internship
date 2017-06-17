import boto
from boto.s3.key import Key
import os
# login credentials
AWS_ACCESS_KEY_ID = '*************'
AWS_SECRET_ACCESS_KEY = '***********************'
# connection to S3
conn = boto.connect_s3(AWS_ACCESS_KEY_ID,AWS_SECRET_ACCESS_KEY)
# Locating the bucket
mybucket = conn.get_bucket('*************')## Our bucket name

# adding the files in the folder to s3 bucket
for root, dirs, files in os.walk('C:\\Users\\singhsi\\Desktop\\Pixability'):# change this to your source address
    for name in files:
        source_path = root.split(os.path.sep)[1:]
        path_from_dirs = source_path[len(source_path) - 1:]
        path_from_dirs.append(name)
        source_path.append(name)
        source_path.insert(0,"c:\\")
        key_path = os.path.join(*path_from_dirs)
        source_path = os.path.join(*source_path)
        k = Key(mybucket)
        k.key = key_path
        k.set_contents_from_filename(source_path)
        print(name,'--',source_path, '--', key_path)
        print(os.path.getsize(source_path))

# prints our the files in the bucket after update
for key in mybucket.list():
    print(key.name.encode('utf-8'))
