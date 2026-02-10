def buildPart(cords, size, clas):
    style  = " left: " + cords[0] + "px; top: " + cords[1] + "px; " + "width: " + size[0] + "px; height: " + size[1] + "px"  
    part = "<div style=\"" + style + "\"></div>"

    styleCubed  = " left: " + cords[0] + "px; top: " + cords[1] + "px; " + "--width: " + size[0] + "px; --height: " + size[1] + "px; --depth: " + size[2] + "px;"  
    for i in range(len(size) - 3):
        styleCubed += "--arg" + str(i) + ": " + size[i+3] + "; "

    cubes = "<div></div>"*6
    partCubed = "<div class=\"cubed " + clas + "\" style=\"" + styleCubed + "\">" + cubes + "</div>"
    return part, partCubed

def getMap():
    map = open("src/map.txt")
    rects = map.read().split("\n")[:-1]
    rectsDone = ""
    cubesDone = ""
      
    for rect in rects:
        if (rect[0] != "/"):
            parts = rect.split(";")
            cords = parts[0].split(",")
            size = parts[1].split(",")
            clas = parts[2]
            

            addRect, addCubed = buildPart(cords, size, clas)
            if not (len(parts) >= 4 and parts[3] == "noCol"):
                rectsDone += addRect

            cubesDone += addCubed 
    map.close()
    return rectsDone, cubesDone
  



  


