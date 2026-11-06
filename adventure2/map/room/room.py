from ..primitives.coord import Coord
from ..primitives.size import Size
from ..primitives.part import Part
from ..primitives.html_element import HtmlElement
from ..primitives.style import Style
from ..furniture.furniture import Furniture
from .wall.wall import Wall
from .wall.wall_openings import WallOpenings
from .wall.wall_argss import WallArgss


class Room:
    ROOF_THICCNESS = 10

    walls: list[Wall]
    roof: Part 
    children: list["Furniture"]

    def get_visual_cubes(self):
        for wall in self.walls:
            for cube in wall.get_visual_cubes():
                yield cube
            for child in self.children:
                yield child.part
        yield self.roof

    def get_html_elements(self):
        return self.floor

    def get_collision_rects(self):
        for wall in self.walls:
            for cube in wall.get_collision_rects():
                yield cube
            for child in self.children:
                yield child.part

    def __init__(self, position: Coord, size: Size, css_classes: list[str], wall_thickness: float, doors: WallOpenings, wall_args: WallArgss, children: list[Furniture]):
        self.walls = wall_args.to_wall_list(position, size, wall_thickness, doors, css_classes)
        self.roof = Part(
            position + (wall_thickness, wall_thickness),
            Size(size.width - wall_thickness, size.height - wall_thickness, Room.ROOF_THICCNESS),
            css_classes=["roof"],
            args=['200px'])

        self.floor = HtmlElement(
            "div",
            style=[
                Style("left", position.x, "px"),
                Style("top", position.y, "px"),
                Style("width", size.width + wall_thickness, "px"),
                Style("height", size.height + wall_thickness, "px"),
            ],
            css_classes=["floor", "wood"],
        )

        self.children = children
        for child in self.children:
            child.translate(position)
