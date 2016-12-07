defmodule Aoc16.Day05 do

  def run do
    input = "ugkcyxxp"
    {calculate_password(input), calculate_positional_password(input)}
  end

  def calculate_password(door_id, code \\ "", round \\ 0)

  def calculate_password(_door_id, code, _round) when byte_size(code) == 8 do
    code
  end

  def calculate_password(door_id, code, round) do
    result =
      door_id <> Integer.to_string(round)
      |> :erlang.md5()
      |> Base.encode16(case: :lower)

    code = case result do
      "00000" <> rest ->
        code <> String.at(rest, 0)
      _ ->
        code
    end

    calculate_password(door_id, code, round + 1)
  end

  def calculate_positional_password(door_id, code \\ "________", num_decoded \\ 0, round \\ 0)

  def calculate_positional_password(_door_id, code, num_decoded, _round) when num_decoded == 8 do
    code
  end

  def calculate_positional_password(door_id, code, num_decoded, round) do
    result =
      door_id <> Integer.to_string(round)
      |> :erlang.md5()
      |> Base.encode16(case: :lower)

    {code, num_decoded} = case result do
      "00000" <> rest ->
        with {position, _} <- String.at(rest, 0) |> Integer.parse, "_" <- String.at(code, position) do
          if position <= 7 do
            character = String.at(rest, 1)

            code = String.graphemes(code)
            |> List.replace_at(position, character)
            |> Enum.join

            {code, num_decoded + 1}
          else
            {code, num_decoded}
          end
        else
          _ -> {code, num_decoded}
        end
      _ ->
        {code, num_decoded}
    end

    calculate_positional_password(door_id, code, num_decoded, round + 1)
  end
end
