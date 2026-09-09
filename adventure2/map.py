def buildPart(cords, size, clas):
    for i in range(len(cords)):
        cords[i] = str(cords[i])
    for i in range(max(len(size), 3)):
        size[i] = str(size[i])
    style  = " left: " + cords[0] + "px; top: " + cords[1] + "px; " + "width: " + size[0] + "px; height: " + size[1] + "px"  
    part = "<div style=\"" + style + "\"></div>"

    styleCubed  = " left: " + cords[0] + "px; top: " + cords[1] + "px; " + "--width: " + size[0] + "px; --height: " + size[1] + "px; --depth: " + size[2] + "px;"  
    for i in range(len(size) - 3):
        styleCubed += "--arg" + str(i) + ": " + size[i+3] + "; "

    cubes = "<div></div>"*6
    partCubed = "<div class=\"cubed " + clas + "\" style=\"" + styleCubed + "\">" + cubes + "</div>"
    return part, partCubed

def buildRoom(cords, size, classe, t, doors):
    w = size[0]
    h = size[1]
    x = cords[0]
    y = cords[1]
    rect = ""
    cubed = ""
    wallsDone = []
    dorPos = {}
    dorWidth = {}
    for door in doors:
        wallsDone.append(int(door[0]))
        dorPos[int(door[0])] = int(door[1])
        dorWidth[int(door[0])] = int(door[2])
    print(wallsDone, dorPos, dorWidth)
    clas = classe + " north"
    if 1 in wallsDone:
        addRect, addCubed = buildPart(cords, [dorPos[1], t, size[2]], clas)
        rect += addRect
        cubed += addCubed
        addRect, addCubed = buildPart([x+dorPos[1], y], [dorWidth[1], t, size[2]-100], "pole " + clas)
        cubed += addCubed
        addRect, addCubed = buildPart([x+dorPos[1] + dorWidth[1], y], [w-dorWidth[1]-dorPos[1], t, size[2]], clas)
        rect += addRect
        cubed += addCubed
    else:
        addRect, addCubed = buildPart(cords, [w, t, size[2]], clas)
        rect += addRect
        cubed += addCubed
    clas = classe + " east"
    if 2 in wallsDone:
        addRect, addCubed = buildPart([x+w, y], [t, dorPos[2], size[2]], clas)
        rect += addRect
        cubed += addCubed
        addRect, addCubed = buildPart([x+w, y+dorPos[2]], [t, dorWidth[2], size[2]-100], "pole " + clas)
        cubed += addCubed
        addRect, addCubed = buildPart([x+w, y+dorPos[2]+dorWidth[2], y], [t, h-dorWidth[2]-dorPos[2], size[2]], clas)
        rect += addRect
        cubed += addCubed
    else:
        addRect, addCubed = buildPart([x+w, y], [t, h, size[2]], clas)
        rect += addRect
        cubed += addCubed
    clas = classe + " south"
    if 3 in wallsDone:
        addRect, addCubed = buildPart([x+t, y+h], [dorPos[3], t, size[2]], clas)
        rect += addRect
        cubed += addCubed
        addRect, addCubed = buildPart([x+t+dorPos[3], y+h], [dorWidth[3], t, size[2]-100], "pole " + clas)
        cubed += addCubed
        addRect, addCubed = buildPart([x+t+dorPos[3] + dorWidth[3], y+h], [w-dorWidth[3]-dorPos[3], t, size[2]], clas)
        rect += addRect
        cubed += addCubed
    else:
        addRect, addCubed = buildPart([x+t, y+h], [w, t, size[2]], clas)
        rect += addRect
        cubed += addCubed
    clas = classe + " west"
    if 4 in wallsDone:
        addRect, addCubed = buildPart([x, y+t], [t, dorPos[4], size[2]], clas)
        rect += addRect
        cubed += addCubed
        addRect, addCubed = buildPart([x, y+t+dorPos[4]], [t, dorWidth[4], size[2]-100], "pole " + clas)
        cubed += addCubed
        addRect, addCubed = buildPart([x, y+t+dorPos[4]+dorWidth[4], y], [t, h-dorWidth[4]-dorPos[4], size[2]], clas)
        rect += addRect
        cubed += addCubed
    else:
        addRect, addCubed = buildPart([x, y+t], [t, h, size[2]], clas)
        rect += addRect
        cubed += addCubed
    addRect, addCubed = buildPart([x+t, y+t, 200], [w-t, h-t, 10, "200px"], "roof")
    cubed += addCubed
    return rect, cubed

def getMap():
    map = open("src/map.txt")
    rects = map.read().split("\n")[:-1]
    rectsDone = ""
    cubesDone = ""
      
    for rect in rects:

        print(rect)
        if (rect[0] != "/"):
            parts = rect.split(";")
            cords = parts[0].split(",")
            size = parts[1].split(",")
            clas = parts[2]

            if (rect[0][0] == ":"):
                cords[0] = cords[0][1:]
            for i in range(len(cords)):
                cords[i] = int(cords[i])
            for i in range(len(size)):
                size[i] = int(size[i])
            if (rect[0][0] == ":"):
                doors = parts[3].split("$")[1:]
                for i in range(len(doors)):
                    doors[i] = doors[i].split(",")
                print(doors)
                addRect, addCubed = buildRoom(cords, size, clas, 20, doors)
            else:
                addRect, addCubed = buildPart(cords, size, clas)
            if not (len(parts) >= 4 and parts[-1] == "noCol"):
                rectsDone += addRect

            cubesDone += addCubed
    map.close()
    return rectsDone, cubesDone
  



  


