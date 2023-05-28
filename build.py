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


def main():
  shutil.rmtree(BUILD_OUT)
  copy_tree('src', BUILD_OUT)

  header = open('www/header.html', 'r').read()
  for path in get_all_html(BUILD_OUT):
      contents = ''
      with open(path, 'r') as f:
        contents = f.read()
        contents = contents.replace('HEADER_PLACEHOLDER', header)
      with open(path, 'w') as f:
        f.write(contents)


if __name__ == '__main__':
  main()