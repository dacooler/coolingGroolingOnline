class Size:
    width: float
    height: float
    depth: float

    def __init__(self, width: float, height: float, depth: float):
        self.width = width
        self.height = height
        self.depth = depth

    @staticmethod
    def from_json(json: dict[str, float]):
        return Size(json['width'], json['height'], json['depth'])

    def clone(self):
        return Size(self.width, self.height, self.depth)
