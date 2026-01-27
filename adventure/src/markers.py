markerFile = open("markers.txt")
newMark = True
markName = ""
markers = {}
for line in markerFile.readlines():
    print([line])
    if line == "\n":
        print("newmark")
        newMark = True 
    elif newMark:
        markName = line[:-1]
        markers[markName] = []
        newMark = False
    else:
        markers[markName].append(line.split())
markerFile.close()
file = ""
for name, marker in markers.items():
    print("name: ")
    print(name)
    print("marker: ")
    print(marker)
    file += name + "\n"

print(markers)








