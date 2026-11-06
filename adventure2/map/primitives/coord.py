class Coord:
    x: float
    y: float

    def __init__(self, x: float, y: float):
        self.x = x
        self.y = y

    @staticmethod
    def from_json(json: dict[str, float]):
        return Coord(json['x'], json['y'])

    def clone(self):
        return Coord(self.x, self.y)

    def __add__(self, other):
        if isinstance(other, Coord):
            return Coord(self.x + other.x, self.y + other.y)
        elif isinstance(other, list) or isinstance(other, tuple):
            return Coord(self.x + other[0], self.y + other[1])
        else:
            raise TypeError('Coord can only be added with other Coords or tuples or lists')