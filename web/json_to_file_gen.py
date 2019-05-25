import json
import os
import random


def get_modules(folder: str) -> list:
    modules = []
    for item in os.listdir(folder):
        # print(item)
        if os.path.isfile(folder + "/" + item):
            file_name, file_ext = os.path.splitext(item)
            if file_ext == ".png" or file_ext == ".gif":
                modules.append({file_name: file_ext})
    return modules


images = get_modules("./solo02")
combine_obj = {}

for img in images:
    for key, value in img.items():
        name = key.replace("_", " ")
        price = "$"
        dollars = random.randint(1, 1000)
        cents = random.randint(0, 99)
        if cents < 10:
            price += str(dollars) + '.0' + str(cents)
        else:
            price += str(dollars) + '.' + str(cents)
        combine_obj[name] = {
            "price": price,
            "img": f"{key + value}"
        }

with open("C:\\Bitnami\\wampstack-7.0.23-0\\apache2\\htdocs\\solo02\\items.json", 'w+') as fh:
    json.dump(combine_obj, fh, indent=4)


# Archived Uses:

# Reducing the size of the crawler output to just include the things desired.
# with open("../results/prod/mouniversaltemplate/WWW Page - urls.json", "r") as fh:
#     json_obj = json.loads(fh.read())
# new_json_obj = {'list': []}
# for line in json_obj['url']:
#     new_json_obj['list'].append({"url": line})
# for key, value in json_obj.items():
#     new_json_obj['url'].append(key)

# Creating a titan, youtube, brightcove, download audio, download video - id files
# fh = open("../resources/downloadVideo.txt", 'r')
# for line in fh.readlines():
#     json_obj['list'].append(line.replace('\n', ''))
# fh.close()

# Converting Celia's url list to json objects
# raw_url_file = "C:\\Users\\Iskirra\\PycharmProjects\\qa\\results\\prod\\mouniversaltemplate\\prod_published.txt"
# fh = open(raw_url_file)
# lines = fh.readlines()
# temp_obj = {}
# inc = 1
# for line in lines:
#     temp_obj = {"name": f"Test {inc}", "uri": None, "preview_url": line, "cms url": None}
#     json_obj['list'].append(temp_obj)
#     inc += 1
# fh.close()
