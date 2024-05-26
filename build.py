import os
import shutil
from distutils.dir_util import copy_tree


BUILD_OUT = 'www'

def get_all_html(directory):
  matches = []
  for root, dirs, files in os.walk(directory):
    for file in files:
      if file.endswith('.html'):
        matches.append(os.path.join(root, file))    
  return matches

def replace_placeholder_with_file(placeholder, file_path):
  header = open(file_path, 'r').read()
  for path in get_all_html(BUILD_OUT):
      contents = ''
      with open(path, 'r') as f:
        contents = f.read()
        contents = contents.replace(placeholder, header)
      with open(path, 'w') as f:
        f.write(contents)  

def main():
  shutil.rmtree(BUILD_OUT)
  copy_tree('src', BUILD_OUT)

  replace_placeholder_with_file('BODY_HEADER_PLACEHOLDER', 'www/templates/header.html')
  replace_placeholder_with_file('COMMON_HEAD_PLACEHOLDER', 'www/templates/common_head.html')


if __name__ == '__main__':
  main()