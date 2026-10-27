from ..coord import Coord
from .wall.wall import Wall
from .wall.wall_openings import WallOpenings
from ..size import Size
from ..sized_part import SizedPart


class Room:
    ROOF_THICCNESS = 10

    walls: list[Wall]
    roof: SizedPart 
    """Part with no collision."""

    def get_visual_cubes(self):
        for wall in self.walls:
            for cube in wall.get_visual_cubes():
                yield cube
        yield self.roof
        yield self.floor

    def get_collision_rects(self):
        for wall in self.walls:
            for cube in wall.get_collision_rects():
                yield cube

    def __init__(self, position: Coord, size: Size, css_classes: list[str], wall_thickness: float, doors: WallOpenings):
        self.walls = [
            Wall(
                position,
                Size(size.width, wall_thickness, size.depth),
                doors.get_openings_of_wall(0),
                css_classes + ['north'],
                True
            ),
            Wall(
                position + (size.width, 0),
                Size(wall_thickness, size.height, size.depth),
                doors.get_openings_of_wall(1),
                css_classes + ['east'],
                False
            ),
            Wall(
                position + (wall_thickness, size.height),
                Size(size.width, wall_thickness, size.depth),
                doors.get_openings_of_wall(2),
                css_classes + ['south'],
                True
            ),
            Wall(
                position + (0, wall_thickness),
                Size(wall_thickness, size.height, size.depth),
                doors.get_openings_of_wall(3),
                css_classes + ['west'],
                False
            ),
        ]

        self.roof = SizedPart(
            position + (wall_thickness, wall_thickness),
            Size(size.width - wall_thickness, size.height - wall_thickness, Room.ROOF_THICCNESS),
            css_classes=["roof"],
            args=['200px'])

        self.floor = SizedPart(
            position,
            Size(size.width + wall_thickness, size.height + wall_thickness, 1),
            css_classes=["floor"],
        )
